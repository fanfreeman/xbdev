<?php

// constants for directory and file permission codes
define("PERMISSION_OWN",		5); // all permissions
define("PERMISSION_ADMIN",		4); // all permissions of 3, plus adminitration priviledges
define("PERMISSION_SHARE",		3); // all permissions of 4, plus sharing with other users
define("PERMISSION_COMMENT",	2); // all permissions of 5, plus view and add comments
define("PERMISSION_READ",		1); // view file details, see users and download
define("PERMISSION_NONE",		0); // no access

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {
	private $temp;
	private $hash;
	
	function __construct() {
		$input = fopen("php://input", "r");
		$this->temp = tmpfile();
		$realSize = stream_copy_to_stream($input, $this->temp);
		
		fclose($input);
		
		if ($realSize != $this->getSize()){
			//return false;
			throw new Exception('Uploaded file size error.');
		}
		
		$pathinfo = pathinfo($this->getName());
		$filename = $pathinfo['filename'];
		$ext = $pathinfo['extension'];
		
		$strTempPath = Yii::app()->getRuntimePath() . '/' . $filename . '.' . $ext;
		$target = fopen($strTempPath, "w");
		fseek($this->temp, 0, SEEK_SET);
		stream_copy_to_stream($this->temp, $target);
		fclose($target);
		
		$this->hash = md5_file($strTempPath).$realSize;
		unlink($strTempPath);
	}
	
	function getHash() {
		return $this->hash;
	}
	
	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	function save($path) {
		$target = fopen($path, "w");
		fseek($this->temp, 0, SEEK_SET);
		stream_copy_to_stream($this->temp, $target);
		fclose($target);

		return true;
	}
	
	function getName() {
		return $_GET['qqfile'];
	}
	
	function getSize() {
		if (isset($_SERVER["CONTENT_LENGTH"])){
			return (int)$_SERVER["CONTENT_LENGTH"];
		} else {
			throw new Exception('Getting content length is not supported.');
		}
	}
}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {
	function getHash() {
		return md5_file($_FILES['qqfile']['tmp_name']).$this->getSize();
	}
	
	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	function save($path) {
		if(!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)){
			return false;
		}
		return true;
	}
	
	function getName() {
		return $_FILES['qqfile']['name'];
	}
	
	function getSize() {
		return $_FILES['qqfile']['size'];
	}
}

class FileSystem
{
	/*
    private $config = array(
        'servers' => array(),
        'readDatebases'  => array(),
        'writeDatebases' => array()
    );
    */
	
	private static $mimetypes = null;

    function __construct()
    {
        $this->config = include Yii::app()->basePath.'/config/storage.php';
        //print_r($this->config);exit;
        //$this->config = array_merge($this->config, $arrayConfig);
        error_reporting(E_ALL | E_STRICT);
        ini_set('display_errors', 1);
    }

    /*
     * returns the physical path representing a storage server given path id
     */
    private function getServer($intPathIndexId)
    {
        $key = $intPathIndexId % count($this->config['servers']);

        return $this->config['servers'][$key];
    }

    /*
     * add a server dynamically into the server array
     */
    public function addServer($strServer)
    {
        array_push($this->config['servers'], $strServer);

        return $this;
    }

    /*
     * acquire a db for reading
     */
    private function getDB($type = 'read')
    {
        $arrayDBs = $this->config[$type.'Datebases'];
        shuffle($arrayDBs);

        return current($arrayDBs);
    }

    /*
     * find file id given hash and file name
     */
    private function getFileIndexId($strFileMd5, $strFileName, $strExtension)
    {
        $connection = $this->getDB();
        $sql = "SELECT * FROM {{storage_file_index}} WHERE unique_id = :strFileMd5 AND file_name = :strFileName AND extension = :strExtension LIMIT 1";
        $command = $connection->createCommand($sql);
        $command->bindParam(":strFileMd5", $strFileMd5, PDO::PARAM_STR);
        $command->bindParam(":strFileName", $strFileName, PDO::PARAM_STR);
        $command->bindParam(":strExtension", $strExtension, PDO::PARAM_STR);
        if (!$arrayResult = $command->queryRow()) {
            return false;
        }
        return $arrayResult['storage_file_index_id'];
    }

    /*
     * insert a new record into the file index table given hash and file name
     */
    private function insertFileIndex($strFileMd5, $strFileName, $strExtension, $intSize)
    {
        $connection = $this->getDB('write');
        $strCurrentTime = time();
        //$sql = "INSERT INTO {{storage_file_index}} (unique_id, directory_id, file_name, extension, size, created, updated) VALUES ('$strFileMd5', '$intDirId', '$strFileName', '$strExtension', '$intSize', '$strCurrentTime', '$strCurrentTime')";
        $sql = "INSERT INTO {{storage_file_index}} (unique_id, file_name, extension, size, created, updated) VALUES (:strFileMd5, :strFileName, :strExtension, :intSize, :strCurrentTime, :strCurrentTime)";
        $command = $connection->createCommand($sql);
        $command->bindParam(":strFileMd5", $strFileMd5, PDO::PARAM_STR);
        $command->bindParam(":strFileName", $strFileName, PDO::PARAM_STR);
        $command->bindParam(":strExtension", $strExtension, PDO::PARAM_STR);
        $command->bindParam(":intSize", $intSize, PDO::PARAM_STR);
        $command->bindParam(":strCurrentTime", $strCurrentTime, PDO::PARAM_STR);
        $command->execute();
        return $connection->getLastInsertID();
    }
    
    /*
     * Read all files from db in the form of an array of arrays
     */
    public function getAllFiles() {
    	$connection = $this->getDB('write');
    	$strSql = "select * from {{storage_file_index}}";
    	$command = $connection->createCommand($strSql);
    	$objResults = $command->query();
    	
    	return $objResults->readAll();
    }

    /*
     * Check if a file already exists in our storage by checking if its hash is in the path index table
     */
    private function checkPathIndex($strFileMd5)
    {
        $connection = $this->getDB();
        $sql = "SELECT * FROM {{storage_path_index}} WHERE unique_id = '$strFileMd5' LIMIT 1";
        $command = $connection->createCommand($sql);
        if (!$arrayResult = $command->queryRow()) {
            return false;
        }
        return true;
    }

    /*
     * Insert a new record into the path index table given hash
     */
    private function insertPathIndex($strFileMd5)
    {
        $connection = $this->getDB('write');
        $sql = "INSERT INTO {{storage_path_index}} (unique_id) VALUES ('$strFileMd5')";
        $command = $connection->createCommand($sql);
        $command->execute();

        return $connection->getLastInsertID();
    }

    /*
     * Given path index id, update its corresponding file path
     */
    private function updatePathIndexFilePath($intPathIndexId, $strFilePath)
    {
        $connection = $this->getDB('write');
        $sql = "UPDATE {{storage_path_index}} SET file_path = '$strFilePath' WHERE storage_path_index_id = '$intPathIndexId'";
        $command = $connection->createCommand($sql);

        return $command->execute();
    }

    /*
     * Calculate the (hopefully) unique hash of a file
     */
    private function getFileMd5($strFile)
    {
        return md5_file($strFile).filesize($strFile);
    }

    /*
     * Get hash and file name given file id
     */
    protected function readInfo($fid)
    {
        $connection = $this->getDB();
        $sql = "SELECT * FROM {{storage_file_index}} WHERE storage_file_index_id = '$fid' LIMIT 1";
        $command = $connection->createCommand($sql);
        if (!$arrayResult = $command->queryRow()) {
            return false;
        }
        
        return $arrayResult;
    }
    
    /**
     * Get file path info given unique id
     * 
     * @param string $strUniqueId the unique id of the file
     * @return array the file path info (storage_path_index_id, file_path)
     */
    protected function readPathInfo($strUniqueId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_path_index}} WHERE unique_id = '$strUniqueId' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrResult = $command->queryRow()) {
    		return false;
    	}
    	
    	return $arrResult;
    }
    
    /**
     * Remove a path index record given unique hash
     * 
     * @param string $strUniqueId the unique hash of the physical file
     * @return
     */
    protected function removePathIndex($strUniqueId) {
    	$connection = $this->getDB('write');
    	//$sql = "delete from  {{storage_path_index}} where unique_id = {'$strUniqueId'};
    	$sql = "delete from  {{storage_path_index}} where unique_id = '" . $strUniqueId . "'";
    	$command = $connection->createCommand($sql);
    	$command->execute();
    	
    	return true;
    }

    /*
     * Given file index id, read contents of the physical file
     */
    public function readData($fid)
    {
        if (!$arrayResult = $this->readInfo($fid)) {
            return false;
        }
        
        $connection = $this->getDB();
        $sql = "SELECT * FROM {{storage_path_index}} WHERE unique_id = '{$arrayResult['unique_id']}' LIMIT 1";
        $command = $connection->createCommand($sql);
        if (!$arrayResult = $command->queryRow()) {
            return false;
        }

        return @file_get_contents(Yii::app()->getRuntimePath() . $arrayResult['file_path']);
    }
    
    /*
     * Given file index id, download this file
     */
    public function download($fid) {
    	if (!$arrFileInfo = $this->readInfo($fid)) {
    		return array('error' => 'file not found');
    	}
    	
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_path_index}} WHERE unique_id = '{$arrFileInfo['unique_id']}' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrFilePath = $command->queryRow()) {
    		return array('error' => 'could not download file (1000)');
    	}
    	$strFilePathPhysical = Yii::app()->getRuntimePath() . $arrFilePath['file_path'];
    	
    	// output file content to buffer
    	header('Content-Disposition: attachment; filename="' . $arrFileInfo['file_name'] . '.' . $arrFileInfo['extension'] . '"');
    	header('Content-Transfer-Encoding: binary');
    	header('Expires: 0');
    	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    	header('Pragma: public');
    	
    	$zip = false; //TODO
    	if($zip){ 
    		header('Content-Type: application/zip');
    		header('Content-Length: ' . filesize($strFilePathPhysical));
    	} else {
    		header('Content-Type: ' . self::getMimeType($strFilePathPhysical, $arrFileInfo['extension']));
    		header('Content-Length: ' . filesize($strFilePathPhysical));
    	}
    	@ob_end_clean();
    	if($zip){
    		readfile($filename);
    		unlink($filename);
    	}else{
    		readfile($strFilePathPhysical);
    	}
    }
    
    private function toBytes($str){
    	$val = trim($str);
    	$last = strtolower($str[strlen($str)-1]);
    	switch($last) {
    		case 'g': $val *= 1024;
    		case 'm': $val *= 1024;
    		case 'k': $val *= 1024;
    	}
    	return $val;
    }
    
    // MARKED for removal
    public function getHomeDirectoryId($intUserId) {
    	$connection = $this->getDB();
    	$sql = "select sd.storage_directory_id from storage_directories sd, storage_directory_permissions sp where sd.parent_id=0 and sp.user_id='$intUserId' and sd.storage_directory_id = sp.storage_directory_id";
    	$command = $connection->createCommand($sql);
    	if ($intHomeDirectoryId = $command->queryScalar()) {
    		return $intHomeDirectoryId;
    	} else {
    		return array('error' => 'could not get user home directory id');
    	}
    }
	
    /**
     * Uploads a file using either octet-stream or multipart form
     * @param integer $intUserId the user uploading the file
     * @param integer $intDirId the directory to upload the file into
     * @param array $allowedExtensions OPTIONAL the list of file extensions allowed
     * @param integer $sizeLimit OPTIONAL the maximum file size allowed
     * @return array either array('success'=>true) or array('error'=>'error message')
     */
    public function handleUpload($intUserId, $intDirId = 0, array $allowedExtensions = array(), $sizeLimit = 10485760) {
    	$allowedExtensions = array_map("strtolower", $allowedExtensions);
    	
    	// check server settings
    	$postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));
        if ($postSize < $sizeLimit || $uploadSize < $sizeLimit){
            $size = max(1, $sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    	
        // create object for saving file
    	if (isset($_GET['qqfile'])) {
    		$file = new qqUploadedFileXhr();
    	} elseif (isset($_FILES['qqfile'])) {
    		$file = new qqUploadedFileForm();
    	} else {
    		return array('error' => 'No files were uploaded.');
    	}
		
    	// check uploaded file size
		$size = $file->getSize();
    	if ($size == 0) {
    		return array('error' => 'File is empty');
    	}
    	if ($size > $sizeLimit) {
    		return array('error' => 'File is too large');
    	}
    	
    	// check uploaded file extension
    	//$pathinfo = pathinfo($file->getName());
    	//$filename = $pathinfo['filename'];
    	//$filename = md5(uniqid());
    	//$extension = $pathinfo['extension'];
    	
    	//
    	mb_internal_encoding("UTF-8");
    	$filename = $file->getName();
    	$dirname = mb_substr($filename, 0, strrpos($filename, '/'));
    	$basename = mb_substr($filename, strrpos($filename, '/'));
    	$extension = mb_substr(strrchr($filename, '.'), 1);
    	$filename = mb_substr($basename, 0, strrpos($basename, '.'));
    	//echo $filename; exit;
    	//
    	//
    	
    	if($allowedExtensions && !in_array(strtolower($extension), $allowedExtensions)){
    		$these = implode(', ', $allowedExtensions);
    		return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
    	}
    	
    	/*
    	if(!$replaceOldFile){
    		/// don't overwrite previous files that were uploaded
    		while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
    			$filename .= rand(10, 99);
    		}
    	}
    	*/
    	
    	// add file to db and physical storage
    	$mixedResult = $this->addFile($file, $filename, $extension, $size);
    	if (is_array($mixedResult) && array_key_exists('error', $mixedResult)) {
    		return array('error' => $mixedResult['error']);
    	} else {
    		$intFileIndexId = $mixedResult;
    		$arrResult = $this->setFilePermissions($intUserId, $intFileIndexId, PERMISSION_OWN, $intDirId);
    		if (is_array($arrResult) && array_key_exists('error', $arrResult)) {
    			return array('error' => $arrResult['error']);
    		} else {
    			return array('success'=>true);
    		}
    	}
    }
    /*
     * Add a newly uploaded file
     */
    public function addFile($objFile, $strFileName = null, $strExtension = null, $intSize)
    {
    	// check if the uploaded file is readable
        //if (!file_exists($strFile) || !is_readable($strFile)) {
        //    return false;
        //}
		
        // give the file a default filename
        //isset($strFileName) || $strFileName = basename($strFile);
        
        // calculate the hash of the file
        $strFileMd5 = $objFile->getHash();
        
        // check if this file already exists
        if ($intFileIndexId = $this->getFileIndexId($strFileMd5, $strFileName, $strExtension)) {
            return $intFileIndexId;
        }
        
        // insert file index
        if (!$intFileIndexId = $this->insertFileIndex($strFileMd5, $strFileName, $strExtension, $intSize)) {
            return array('error' => 'insert file index error');
        }
        
        // if the physical file already exists, return the fid directly
        if ($this->checkPathIndex($strFileMd5)) {
            return $intFileIndexId;
        }
        
        // insert new file path record
        if (!$intPathIndexId = $this->insertPathIndex($strFileMd5)) {
            return array('error' => 'could not insert new file path record');
        }
        
        // save the file to physical location
        $mixedFilePath = $this->saveFile($objFile, $strFileMd5, $this->getServer($intPathIndexId));
        if (is_array($mixedFilePath) && array_key_exists('error', $mixedFilePath)) {
            return array('error' => $mixedFilePath['error']);
        }
		
        // update the path record to include the physical file path
        $this->updatePathIndexFilePath($intPathIndexId, $mixedFilePath);

        // return the file index id
        return $intFileIndexId;
    }
    
    /*
     * save a file at a calculated path
    */
    public function saveFile($objFile, $strFileMd5, $strUploadPath)
    {
    	$strRelativePath = $strUploadPath . date('/Y/m/d', time()) . '/' . $strFileMd5;
    	$strPhysicalFolder = Yii::app()->getRuntimePath() . $strUploadPath . date('/Y/m/d', time());
    	if (!file_exists($strPhysicalFolder) && !@mkdir($strPhysicalFolder, 0777, true)) {
    		return array('error' => 'error saving physical file, directory creation failed');
    	}
    
    	$strTargetFile = $strPhysicalFolder.'/'.$strFileMd5;
    
    	if (!file_exists($strTargetFile)) {
    		if(!$objFile->save($strTargetFile)) {
    			return array('error' => 'error saving physical file');
    		}
    		chmod($strTargetFile, 0777);
    	}
    
    	return  $strRelativePath;
    }
    
    /**
     * Move a file to a target parent directory
     * @param integer $intUserId which user to move the file for
     * @param integer $intFileId the file to move
     * @param integer $intTargetDirectoryId the target parent directory
     * @return boolean true on success, false on failure
     */
    public function moveFile($intUserId, $intFileId, $intTargetDirectoryId) {
    	// check if the file exists
    	if (!$arrFileInfo = $this->readInfo($intFileId)) {
    		return array('error' => 'file does not exist');
    	}
    	
    	// check if the dir to upload to exists
    	if ((int)$intTargetDirectoryId !== 0) {
    		if (!$this->directoryExists($intTargetDirectoryId)) {
    			return array('error' => 'directory to move to does not exist');
    		}
    	}
    	
    	// check if the user has permissions to this file
    	if ($this->getFilePermissions($intUserId, $intFileId) <= PERMISSION_NONE) {
    		return array('error' => 'this user does not have access to this file');
    	}
    	
    	$connection = $this->getDB('write');
    	$sql = "UPDATE {{storage_file_permissions}} SET storage_directory_id = :intTargetDirectoryId WHERE storage_file_index_id = :intFileId AND user_id = :intUserId";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":intTargetDirectoryId", $intTargetDirectoryId, PDO::PARAM_STR);
    	$command->bindParam(":intFileId", $intFileId, PDO::PARAM_STR);
    	$command->bindParam(":intUserId", $intUserId, PDO::PARAM_STR);
    	$command->execute();
    	
    	return array('success' => true);
    }
    
    /**
     * Remove a directory for a specified user
     * This works as follows: if the directory is shared among more than one users,
     * removing the directory for a user simply means revoking that user's permissions
     * to this directory. If the directory is owned by only one user, remove all the
     * files within that directory, and then remove this directory's record from the db
     * @param integer $intUserId
     * @param integer $intDirectoryId
     */
    public function removeDirectoryForUser($intUserId, $intDirectoryId) {
    	$arrDirUsers = array_keys($this->getDirectoryUsers($intDirectoryId));

    	if (in_array($intUserId, $arrDirUsers)) {
    		$result = $this->setDirectoryPermissions($intUserId, $intDirectoryId, 0);
    		if ($result['success'] == true) {
    			if (count($arrDirUsers) > 1) { // only revoke this user's permissions to this directory
   					return array('success' => true);
   				} else { // the user is the only owner of this directory, also need to remove the directory
   					// remove all files in this directory
   					$arrDirectoryContent = $this->readDirectoryContent($intUserId, $intDirectoryId);
   					foreach ($arrDirectoryContent['files'] as $arrFile) {
   						$result = $this->removeFile($arrFile['storage_file_index_id']);
   						if ($result['success'] != true) {
   							return array('error' => $result['error']);
   						}
   					}
   					// remove this directory from db
   					$connection = $this->getDB('write');
   					$sql = "delete from {{storage_directories}} where storage_directory_id=" . $intDirectoryId;
   					$command = $connection->createCommand($sql);
   					$command->execute();
   					return array('success' => true);
   				}
    		} else {
   				return array('error' => $result['error']);
   			}
   		} else {
   			return array('error' => 'the user does not have access to this directory');
   		}
    }
    
    /**
     * Remove a file for a specified user
     * This works as follows: if the file is shared among more than one users,
     * removing the file for a user simply means revoking that user's permissions
     * to this file. If the file is owned by only one user, remove this file from
     * the db and physical storage
     * @param integer $intUserId
     * @param integer $intFileId the file to remove
     * @return bool true on success, false on failure
     */
    public function removeFile($intUserId, $intFileId) {
    	if (!$arrFileInfo = $this->readInfo($intFileId)) {
    		return array('error' => 'file not found');
    	}
    	
    	$arrFileUsers = array_keys($this->getFileUsers($intFileId));
    	if (in_array($intUserId, $arrFileUsers)) {
    		$result = $this->setFilePermissions($intUserId, $intFileId, 0);
    		if ($result['success'] == true) {
    			if (count($arrFileUsers) > 1) { // only revoke this user's permissions to this file
    				return array('success' => true);
    			} else { // the user is the only owner of this file, remove from db and physical storage
    				$intFileUniqueId = $arrFileInfo['unique_id'];
    				$connection = $this->getDB();
    				$sql = "SELECT * FROM {{storage_file_index}} WHERE unique_id = '{$intFileUniqueId}' and storage_file_index_id != '{$intFileId}' LIMIT 1";
    				$command = $connection->createCommand($sql);
    				if (!$arrFiles = $command->queryRow()) { // no other file shares the same physical file, remove physical file and path index record
    					// delete physical file
    					$arrPathInfo = $this->readPathInfo($intFileUniqueId);
    					$strPath = Yii::app()->getRuntimePath() . $arrPathInfo['file_path'];
    					unlink($strPath);
    					// remove path index
    					$this->removePathIndex($intFileUniqueId);
    				}
    				
    				//remove file index record
    				$connection = $this->getDB('write');
    				$sql = "delete from {{storage_file_index}} where storage_file_index_id=" . $intFileId;
    				$command = $connection->createCommand($sql);
    				$command->execute();
    				
    				return array('success' => true);
    			}
    		} else {
    			return array('error' => $result['error']);
    		}
    	} else {
    		return array('error' => 'the user does not have access to this directory');
    	}
    }
    
    /**
     * Combine two files, creating a new directory at the same place
     * as the second file, giving the new directory a default name,
     * and moving both files into this directory
     * @param integer $intFileIdFirst
     * @param integer $intFileIdSecond
     * @return array the id and name of the newly created directory
     */
    public function combineFiles($intUserId, $intFileIdFirst, $intFileIdSecond) {
    	// make sure the first file exists
    	if (!$arrFileInfo = $this->readInfo($intFileIdFirst)) {
    		return array('error' => 'first file does not exist');
    	}
    	
    	// make sure the second file exists
    	if (!$arrFileInfo = $this->readInfo($intFileIdSecond)) {
    		return array('error' => 'second file does not exist');
    	}
    	
    	// create a new directory
    	$intNewDirId = $this->addDirectory($intUserId);
    	
    	// move the two files into this new directory
    	if(!$this->moveFile($intUserId, $intFileIdFirst, $intNewDirId)) {
    		return array('error' => 'could not move first file');
    	}
    	
    	if(!$this->moveFile($intUserId, $intFileIdSecond, $intNewDirId)) {
    		return array('error' => 'could not move second file');
    	}
    	
    	return array(
    			'success'	=>	true,
    			'did'		=>	$intNewDirId,
    			'dname'		=>	'New Directory'
    	);
    }
    
    // MARKED for removal
    /**
     * Add a home directory for a new user
     */
    public function addHomeDirectory($intUserId) {
    	// add record to storage_directories
    	$connection = $this->getDB('write');
    	$strCurrentTime = time();
    	$sql = "INSERT INTO {{storage_directories}} (parent_id, name, created, updated) VALUES (0, 'Home', " . $strCurrentTime . ", " . $strCurrentTime . ")"; // (0, 'Home', 123, 123)
    	$command = $connection->createCommand($sql);
    	$command->execute();
    	$intNewDirId = $connection->getLastInsertID();
    	
    	// add directory permission record
    	$arrResult = $this->setDirectoryPermissions($intUserId, $intNewDirId, PERMISSION_OWN);
    	if ($arrResult['success'] !== true) {
    		return array('error' => $arrResult['error']);
    	}
    	
    	return $intNewDirId;
    }
    
    /*
     * Add a new directory
     */
    public function addDirectory($intUserId, $strDirName = 'New Directory') {
    	if (strlen($strDirName) <= 0) {
    		$strDirName = 'New Directory';
    	}
    	
    	// add record to storage_directories
    	$connection = $this->getDB('write');
    	$strCurrentTime = time();
    	$sql = "INSERT INTO {{storage_directories}} (name, created, updated) VALUES ('$strDirName', '$strCurrentTime', '$strCurrentTime')";
    	$command = $connection->createCommand($sql);
    	$command->execute();
    	$intNewDirId = $connection->getLastInsertID();
    	
    	// add directory permission record
    	$arrResult = $this->setDirectoryPermissions($intUserId, $intNewDirId, PERMISSION_OWN);
    	if ($arrResult['success'] !== true) {
    		return array('error' => $arrResult['error']);
    	}
    	
    	return $intNewDirId;
    }
    
    /*
     * Check if the specified directory exists
     */
    public function directoryExists($intDirId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_directories}} WHERE storage_directory_id = '{$intDirId}' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrResult = $command->queryRow()) {
    		return false;
    	}
    	return true;
    }
    
    /**
     * Get detailed info of a directory,
     * including directory name, created and updated dates
     * @param int $intDirectoryId
     */
    public function getDirectoryInfo($intDirectoryId) {
    	if (!$this->directoryExists($intDirectoryId)) {
    		return array('error' => 'directory not found');
    	}
    
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_directories}} WHERE storage_directory_id = '$intDirectoryId' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrayResult = $command->queryRow()) {
    		return array('error' => 'could not read directory info');
    	}
    
    	$arrReturn = array();
    	$arrReturn['name'] = $arrayResult['name'];
    	$arrReturn['created'] = date("F j, Y, g:i a", $arrayResult['created']);
    	$arrReturn['updated'] = date("F j, Y, g:i a", $arrayResult['updated']);
    
    	return $arrReturn;
    }
    
    /**
     * Get detailed info of a file,
     * including file name, extension, size, created and updated dates, list of users
     * @param int $intFileId
     */
    public function getFileInfo($intFileId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_file_index}} WHERE storage_file_index_id = '$intFileId' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrayResult = $command->queryRow()) {
    		return array('error' => 'could not find specified file');
    	}
    	
    	$arrReturn = array();
    	$arrReturn['filename'] = $arrayResult['file_name'];
    	$arrReturn['extension'] = $arrayResult['extension'];
    	$arrReturn['size'] = $arrayResult['size'];
    	$arrReturn['created'] = date("F j, Y, g:i a", $arrayResult['created']);
    	$arrReturn['updated'] = date("F j, Y, g:i a", $arrayResult['updated']);
    	
    	$arrFileUsers = $this->getFileUsers($intFileId);
    	if (is_array($arrFileUsers) && array_key_exists('error', $arrFileUsers)) {
    		return array('error' => $arrFileUsers['error']);
    	}
    	$arrReturn['users'] = $arrFileUsers;
    	$arrReturn['sharecount'] = count($arrFileUsers);
    	
    	return $arrReturn;
    }
    
    /*
     * Given directory id, read the contents of that directory
     */
    public function readDirectoryContent($intUserId, $intDirId = null) {
    	//ensure user has access to this directory
    	if ($intDirId !== null && $intDirId != 0) {
    		if ($this->getDirectoryPermissions($intUserId, $intDirId) <= 0) {
    			return array('error' => 'user does not have permissions to this directory');
    		}
    	}
    	
    	if ($intDirId === null) {
    		$intDirId = 0;
    	}
    	
    	// read directory name
    	$connection = $this->getDB();
    	if ($intDirId == 0) {
    		$strDirName = 'root';
    	} else {
    		$sql = "SELECT name FROM {{storage_directories}} WHERE storage_directory_id = '{$intDirId}' LIMIT 1";
    		$command = $connection->createCommand($sql);
    		if (!$arrDirName = $command->queryRow()) {
    			return array('error' => 'specified directory has no name');
    		}
    		$strDirName = $arrDirName['name'];
    	}
    	
    	// if reading from home directory, also read subdirectories, shared directories, and shared files
    	$arrDirectories = null;
    	if ($intDirId == 0) { // home directory, read shared directories and subdirectories
    		$sql = "SELECT * FROM storage_directories sd, storage_directory_permissions sdp WHERE sdp.user_id = :intUserId AND sd.storage_directory_id = sdp.storage_directory_id"; // and sd.storage_directory_id !=" . $intDirId
    		$command = $connection->createCommand($sql);
    		$command->bindParam(":intUserId", $intUserId, PDO::PARAM_STR);
    		if (!$objSharedDirectories = $command->query()) {
    			return array('error' => 'could not get shared directories');
    		}
    		$arrDirectories = array();
    		while(($row = $objSharedDirectories->read()) !== false) {
    			// get files count
    			$arrDirContents = $this->readDirectoryContent($intUserId, $row['storage_directory_id']);
    			$numFiles = count($arrDirContents['files']);
    			$arrDirectories[] = array('storage_directory_id' => $row['storage_directory_id'], 'name' => $row['name'], 'created' => date("F j, Y, g:i a", $row['created']), 'updated' => date("F j, Y, g:i a", $row['updated']), 'permissions' => $row['permissions'], 'filecount' => $numFiles);
    		}
    	}
    	
    	// read files
    	$arrFiles = array();
    	// if is home directory
    	if ($intDirId == 0) {
    		$sql = "SELECT * FROM storage_file_index sfi, storage_file_permissions sfp WHERE sfp.user_id = :intUserId AND sfp.storage_directory_id = 0 AND sfi.storage_file_index_id = sfp.storage_file_index_id";
    		$command = $connection->createCommand($sql);
    		$command->bindParam(":intUserId", $intUserId, PDO::PARAM_STR);
    		if (!$objFiles = $command->query()) {
    			return array('error' => 'could not get files');
    		}
    		while(($row = $objFiles->read()) !== false) {
    			$arrFiles[] = array('storage_file_index_id' => $row['storage_file_index_id'], 'file_name' => $row['file_name'], 'extension' => $row['extension'], 'size' => $row['size'], 'created' => date("F j, Y, g:i a", $row['created']), 'updated' => date("F j, Y, g:i a", $row['updated']), 'permissions' => $row['permissions']);
    		}
    	} else {
    		$sql = "SELECT * FROM storage_file_index sfi, storage_file_permissions sfp WHERE sfp.storage_directory_id = :intDirId AND sfi.storage_file_index_id = sfp.storage_file_index_id";
    		$command = $connection->createCommand($sql);
    		$command->bindParam(":intDirId", $intDirId, PDO::PARAM_STR);
    		if (!$objFiles = $command->query()) {
    			return array('error' => 'could not get files');
    		}
    		while(($row = $objFiles->read()) !== false) {
    			$arrFiles[] = array('storage_file_index_id' => $row['storage_file_index_id'], 'file_name' => $row['file_name'], 'extension' => $row['extension'], 'size' => $row['size'], 'created' => date("F j, Y, g:i a", $row['created']), 'updated' => date("F j, Y, g:i a", $row['updated']), 'permissions' => $row['permissions']);
    		}
    	}
    	
    	$arrDirContent = array();
    	$arrDirContent['success'] = true;
    	$arrDirContent['name'] = $strDirName;
    	$arrDirContent['directories'] = $arrDirectories;
    	$arrDirContent['files'] = $arrFiles;
    	
    	return $arrDirContent;
    }
    
    /**
     * Rename a file
     * @param int $intFileId the file to rename
     * @param string $strNewName the new file name
     * @return bool true on success, false on failure
     */
    public function renameFile($intUserId, $intFileId, $strNewName) {
    	// check if the specified file exists
    	if (!$arrFileInfo = $this->readInfo($intFileId)) {
    		return array('error' => 'file does not exist');
    	}
    	
    	if ($this->getFilePermissions($intUserId, $intFileId) < PERMISSION_ADMIN) {
    		return array('error' => 'user does not have admin permissions to this file');
    	}
    
    	// check if the new name is valid
    	if (strlen($strNewName) < 1) {
    		return array('error' => 'invalid file name');
    	}
    
    	$connection = $this->getDB('write');
    	$sql = "update {{storage_file_index}} set file_name= :strNewName where storage_file_index_id= :intFileId";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":strNewName", $strNewName, PDO::PARAM_STR);
    	$command->bindParam(":intFileId", $intFileId, PDO::PARAM_STR);
    	$command->execute();
    
    	return array('success' => true);
    }
    
    /**
     * Rename a directory
     * @param integer $intUserId
     * @param integer $intDirectoryId the directory to rename
     * @param string $strNewName the new directory name
     * @return bool true on success, false on failure
     */
    public function renameDirectory($intUserId, $intDirectoryId, $strNewName) {
    	if (!$this->directoryExists($intDirectoryId)) {
    		return array('error' => 'specified directory does not exist');
    	}
    	
    	if ($this->getDirectoryPermissions($intUserId, $intDirectoryId) < PERMISSION_ADMIN) {
    		return array('error' => 'user does not have admin permissions to this directory');
    	}
    
    	// check if the new name is valid
    	if (strlen($strNewName) < 1) {
    		return array('error' => 'invalid directory name');
    	}
    
    	$connection = $this->getDB('write');
    	$sql = "update {{storage_directories}} set name='" . $strNewName . "' where storage_directory_id=" . $intDirectoryId;
    	$command = $connection->createCommand($sql);
    	$command->execute();
    
    	return array('success' => true);
    }
    
    /**
     * Share a directory with a list of users
     * @param integer $intUserId
     * @param integer $intDirectoryId
     * @param array $arrUsers
     */
    public function shareDirectory($intUserId, $intDirectoryId, $arrUsers) {
    	if (!$this->directoryExists($intDirectoryId)) {
    		return array('error' => 'specified directory does not exist');
    	}
    	
    	if ($this->getDirectoryPermissions($intUserId, $intDirectoryId) < PERMISSION_SHARE) {
    		return array('error' => 'user does not have sharing permissions to this directory');
    	}

    	foreach ($arrUsers as $strReceivingUserId) {
    		if (strlen($strReceivingUserId) <= 0) continue;
    		$intReceivingUserId = (int)$strReceivingUserId;
    		if (is_int($intReceivingUserId)) {
    			// give each user sharing permission to this directory
    			$this->setDirectoryPermissions($intReceivingUserId, $intDirectoryId, PERMISSION_SHARE);
    		} else {
    			return array('error' => 'user id list error, must be integers');
    		}
    	}
    	
    	return array('success' => true);
    }
    
    /**
     * Share a file with a list of users
     * @param integer $intUserId
     * @param integer $intFileId
     * @param array $arrUsers
     */
    public function shareFile($intUserId, $intFileId, $arrUsers) {
    	// check if the specified file exists
    	if (!$arrFileInfo = $this->readInfo($intFileId)) {
    		return array('error' => 'specified file does not exist');
    	}
    	
    	if ($this->getFilePermissions($intUserId, $intFileId) < PERMISSION_SHARE) {
    		return array('error' => 'user does not have sharing permissions to this file');
    	}
    	
    	foreach ($arrUsers as $strReceivingUserId) {
    		if (strlen($strReceivingUserId) <= 0) continue;
    		$intReceivingUserId = (int)$strReceivingUserId;
    		if (is_int($intReceivingUserId)) {
    			// give each user sharing permission to this file
    			$this->setFilePermissions($intReceivingUserId, $intFileId, PERMISSION_SHARE);
    		} else {
    			return array('error' => 'user id list error, must be integers');
    		}
    	}
    
    	return array('success' => true);
    }
    
    /**
     * Checks what permission the specified user has to the specified directory
     * @param integer $intUserId
     * @param integer $intDirectoryId
     * @return integer the permission code
     */
    protected function getDirectoryPermissions($intUserId, $intDirectoryId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_directory_permissions}} WHERE storage_directory_id = '{$intDirectoryId}' AND user_id = '{$intUserId}' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrPermissions = $command->queryRow()) {
    		return 0;
    	}
    	$intPermission = $arrPermissions['permissions'];
    	return $intPermission;
    }
    
    /**
     * Checks what permission the specified user has to the specified file
     * @param integer $intUserId
     * @param integer $intFileId
     * @return integer the permission code
     */
    protected function getFilePermissions($intUserId, $intFileId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_file_permissions}} WHERE storage_file_index_id = '{$intFileId}' AND user_id = '{$intUserId}' LIMIT 1";
    	$command = $connection->createCommand($sql);
    	if (!$arrPermissions = $command->queryRow()) {
    		return 0;
    	}
    	$intPermission = $arrPermissions['permissions'];
    	return $intPermission;
    }
    
    /**
     * Set directory permissions for a user
     * @param integer $intUserId
     * @param integer $intDirectoryId
     * @param integer $intPermissions the permission code
     */
    public function setDirectoryPermissions($intUserId, $intDirectoryId, $intPermissions) {
    	// set permissions
    	if ($intPermissions >= 1 && $intPermissions <= 5) {
    		$intCurrentPermissions = $this->getDirectoryPermissions($intUserId, $intDirectoryId);
    		if ($intCurrentPermissions == 0) { // no permissions record present, insert new record
    			$connection = $this->getDB('write');
		    	$sql = "INSERT INTO {{storage_directory_permissions}} (storage_directory_id, user_id, permissions) VALUES ('$intDirectoryId', '$intUserId', '$intPermissions')";
		    	$command = $connection->createCommand($sql);
		    	$command->execute();
		    	return array('success' => true);
    		} else if ($intCurrentPermissions != $intPermissions) { // update existing permissions record
    			$connection = $this->getDB('write');
    			$sql = "update {{storage_directory_permissions}} set permissions = '$intPermissions' where storage_directory_id = '$intDirectoryId' and user_id = '$intUserId'";
    			$command = $connection->createCommand($sql);
    			$command->execute();
    			return array('success' => true);
    		} else {
    			return array('error' => 'permissions to be set already exists');
    		}
    	}
    	
    	// revoke permissions
    	else if ($intPermissions == 0) {
    		$intCurrentPermissions = $this->getDirectoryPermissions($intUserId, $intDirectoryId);
    		if ($intCurrentPermissions != 0) { // remove current permissions record
    			$connection = $this->getDB('write');
    			$sql = "delete from {{storage_directory_permissions}} where storage_directory_id = '$intDirectoryId' and user_id = '$intUserId'";
    			$command = $connection->createCommand($sql);
    			$command->execute();
    			
    			return array('success' => true);
    		} else {
    			return array('error' => 'permissions to revoke does not exist');
    		}
    	}
    	
    	// invalid permissions number
    	else {
    		return array('error' => 'invalid permissions number');
    	}
    }
    
    /**
     * Set file permissions for a user
     * @param integer $intUserId
     * @param integer $intFileId
     * @param integer $intPermissions the permission code
     */
    public function setFilePermissions($intUserId, $intFileId, $intPermissions) {
    	// set permissions
    	if ($intPermissions >= 1 && $intPermissions <= 5) {
    		$intCurrentPermissions = $this->getFilePermissions($intUserId, $intFileId);
    		if ($intCurrentPermissions == 0) { // no permissions record present, insert new record
    			$connection = $this->getDB('write');
    			$sql = "INSERT INTO {{storage_file_permissions}} (storage_file_index_id, user_id, permissions, storage_directory_id) VALUES ('$intFileId', '$intUserId', '$intPermissions', 0)";
    			$command = $connection->createCommand($sql);
    			$command->execute();
    			return array('success' => true);
    		} else if ($intCurrentPermissions != $intPermissions) { // update existing permissions record
    			$connection = $this->getDB('write');
    			$sql = "update {{storage_file_permissions}} set permissions = '$intPermissions' where storage_file_index_id = '$intFileId' and user_id = '$intUserId'";
    			$command = $connection->createCommand($sql);
    			$command->execute();
    			return array('success' => true);
    		} else {
    			return array('error' => 'permissions to be set already exists');
    		}
    	}
    
    	// revoke permissions
    	else if ($intPermissions == 0) {
    		$intCurrentPermissions = $this->getFilePermissions($intUserId, $intFileId);
    		if ($intCurrentPermissions != 0) { // remove current permissions record
    			$connection = $this->getDB('write');
    			$sql = "delete from {{storage_file_permissions}} where storage_file_index_id = '$intFileId' and user_id = '$intUserId'";
    			$command = $connection->createCommand($sql);
    			$command->execute();
    			return array('success' => true);
    		} else {
    			return array('error' => 'permission to revoke does not exist');
    		}
    	}
    
    	// invalid permissions number
    	else {
    		return array('error' => 'invalid permissions number');
    	}
    }
    
    /**
     * Get the list of users who have access to the specified directory
     * @param integer $intDirectoryId
     * @return array the list of users with their permission codes
     */
    public function getDirectoryUsers($intDirectoryId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_directory_permissions}} WHERE storage_directory_id = '{$intDirectoryId}'";
    	$command = $connection->createCommand($sql);
    	if (!$objPermissions = $command->query()) {
    		return array('error' => 'could not get user list or no user has access to this directory');
    	}
    	
    	$arrUsers = array();
    	while(($row = $objPermissions->read()) !== false) {
    		$arrUsers[$row['user_id']] = $row['permissions'];
    	}
    	return $arrUsers;
    }
    
    /**
     * Get the list of users who have access to the specified file
     * @param integer $intFileId
     * @return array the list of users with their permission codes
     */
    public function getFileUsers($intFileId) {
    	$connection = $this->getDB();
    	$sql = "SELECT * FROM {{storage_file_permissions}} WHERE storage_file_index_id = '{$intFileId}'";
    	$command = $connection->createCommand($sql);
    	if (!$objPermissions = $command->query()) {
    		return array('error' => 'could not get user list or no user has access to this file');
    	}
    
    	$arrUsers = array();
    	while(($row = $objPermissions->read()) !== false) {
    		$arrUsers[$row['user_id']] = $row['permissions'];
    	}
    	return $arrUsers;
    }
    
    /**
     * Get the list of users who are sharing files with the specified user
     * @param integer $intUserId the specified user
     * @return array of key-value pairs, where the key is the user id, and the value is the number of files and directories shared between them
     */
    public function getSharingUsers($intUserId) {
    	$connection = $this->getDB();
    	
    	// directory sharing
    	/*
    	$sql = "select user_id, count(user_id) as count from storage_directory_permissions where storage_directory_id in (select storage_directory_id from storage_directory_permissions where user_id = :intUserId) and user_id != :intUserId group by user_id";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":intUserId", $intUserId, PDO::PARAM_STR);
    	if (!$objDirectorySharingUsers = $command->query()) {
    		return array('error' => 'could not get the list of directory sharing users');
    	}
    	$arrUsers = array();
    	while(($row = $objDirectorySharingUsers->read()) !== false) {
    		$arrUsers[$row['user_id']] = $row['count'];
    	}
    	*/
    	
    	// file sharing
    	$sql = "select user_id, count(user_id) as count from storage_file_permissions where storage_file_index_id in (select storage_file_index_id from storage_file_permissions where user_id = :intUserId) and user_id != :intUserId group by user_id";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":intUserId", $intUserId, PDO::PARAM_STR);
    	if (!$objFileSharingUsers = $command->query()) {
    		return array('error' => 'could not get the list of file sharing users');
    	}
    	$arrUsers = array();
    	while(($row = $objFileSharingUsers->read()) !== false) {
    		/*
    		if (array_key_exists($row['user_id'], $arrUsers)) {
    			$arrUsers[$row['user_id']] += $row['count'];
    		} else {
    			$arrUsers[$row['user_id']] = $row['count'];
    		}
    		*/
    		$arrUsers[$row['user_id']] = $row['count'];
    	}
    	
    	return $arrUsers;
    }
    
    /**
     * Get the list of shared directories and files given two users ids
     * @param integer $intUserId1 the first user
     * @param integer $intUserId2 the second user
     * @return array the list of shared directories and files
     */
    public function getSharedItems($intUserId1, $intUserId2) {
    	$connection = $this->getDB();
    	
    	// directory sharing
    	$sql = "select sd.storage_directory_id, name, created, updated, sdp1.permissions from storage_directories sd, storage_directory_permissions sdp1, storage_directory_permissions sdp2 where sdp1.user_id = :intUserId1 and sdp2.user_id = :intUserId2 and sdp1.storage_directory_id = sdp2.storage_directory_id and sd.storage_directory_id = sdp1.storage_directory_id;";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":intUserId1", $intUserId1, PDO::PARAM_STR);
    	$command->bindParam(":intUserId2", $intUserId2, PDO::PARAM_STR);
    	if (!$objSharedDirectories = $command->query()) {
    		return array('error' => 'could not get the list of shared directories');
    	}
    	$arrDirectories = array();
    	while(($row = $objSharedDirectories->read()) !== false) {
    		$arrDirectories[] = array('storage_directory_id' => $row['storage_directory_id'], 'name' => $row['name'], 'created' => date("F j, Y, g:i a", $row['created']), 'updated' => date("F j, Y, g:i a", $row['updated']), 'permissions' => $row['permissions']);
    	}
    	
    	// file sharing
    	$sql = "select sfi.storage_file_index_id, file_name, extension, size, created, updated, sfp1.permissions from storage_file_index sfi, storage_file_permissions sfp1, storage_file_permissions sfp2 where sfp1.user_id = :intUserId1 and sfp2.user_id = :intUserId2 and sfp1.storage_file_index_id = sfp2.storage_file_index_id and sfi.storage_file_index_id = sfp1.storage_file_index_id";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":intUserId1", $intUserId1, PDO::PARAM_STR);
    	$command->bindParam(":intUserId2", $intUserId2, PDO::PARAM_STR);
    	if (!$objSharedFiles = $command->query()) {
    		return array('error' => 'could not get the list of shared files');
    	}
    	$arrFiles = array();
    	while(($row = $objSharedFiles->read()) !== false) {
    		$arrFiles[] = array('storage_file_index_id' => $row['storage_file_index_id'], 'file_name' => $row['file_name'], 'extension' => $row['extension'], 'size' => $row['size'], 'created' => date("F j, Y, g:i a", $row['created']), 'updated' => date("F j, Y, g:i a", $row['updated']), 'permissions' => $row['permissions']);
    	}
    	
    	$arrReturn = array();
    	//$arrReturn['directories'] = $arrDirectories;
    	$arrReturn['files'] = $arrFiles;
    	return $arrReturn;
    }
    
    /**
     * Get only the user's own files, not files shared with the user
     * @param integer $intUserId the specified user
     * @return array the list of files
     */
    public function getMyFiles($intUserId) {
    	$connection = $this->getDB();
    	
    	$sql = "SELECT sfi.storage_file_index_id, file_name, extension, size, created, updated, sfp.permissions FROM storage_file_index sfi, storage_file_permissions sfp WHERE sfp.user_id = :intUserId and sfp.permissions = " . PERMISSION_OWN . " AND sfi.storage_file_index_id = sfp.storage_file_index_id";
    	$command = $connection->createCommand($sql);
    	$command->bindParam(":intUserId", $intUserId, PDO::PARAM_STR);
    	if (!$objMyFiles = $command->query()) {
    		return array('error' => 'could not get my files');
    	}
    	$arrFiles = array();
    	while(($row = $objMyFiles->read()) !== false) {
    		$arrFiles[] = array('storage_file_index_id' => $row['storage_file_index_id'], 'file_name' => $row['file_name'], 'extension' => $row['extension'], 'size' => $row['size'], 'created' => date("F j, Y, g:i a", $row['created']), 'updated' => date("F j, Y, g:i a", $row['updated']), 'permissions' => $row['permissions']);
    	}
    	
    	$arrReturn = array();
    	$arrReturn['files'] = $arrFiles;
    	return $arrReturn;
    }
    
    /**
     * Get the mime type of a given file
     * 
     * @param string $fspath the physical file system path of the file
     * @param string $strLogicalFileName the logical file name of the file
     * @return string the mime type of the file
     */
    protected function getMimeType($fspath, &$extension = null){
    	if(is_readable($fspath)){
    		$mimeType='application/octet-stream';
    		if (@is_dir($fspath)) {
    			// directories are easy
    			return "httpd/unix-directory";
    		}
    		if($mimeType=='application/octet-stream' and function_exists('finfo_open') and function_exists('finfo_file') and $finfo=finfo_open(FILEINFO_MIME)){
    			$mimeType = strtolower(finfo_file($finfo,$fspath));
    			$mimeType = substr($mimeType,0,strpos($mimeType,';'));
    			finfo_close($finfo);
    		}
    		if ($mimeType=='application/octet-stream' && function_exists("mime_content_type")) {
    			// use mime magic extension if available
    			$mimeType = mime_content_type($fspath);
    			
    		}
    		if ($mimeType=='application/octet-stream' && self::canExecute("file")) {
    			// it looks like we have a 'file' command,
    			// lets see it it does have mime support
    			$fspath=str_replace("'","\'",$fspath);
    			$fp = popen("file -i -b '$fspath' 2>/dev/null", "r");
    			$reply = fgets($fp);
    			pclose($fp);
    
    			//trim the character set from the end of the response
    			$mimeType=substr($reply,0,strrpos($reply,' '));
    			
    		}
    		//$mimeType='application/octet-stream'; //
    		if ($mimeType=='application/octet-stream' && isset($extension)) {
    			
    			// Fallback solution: try to guess the type by logical file name extension
    			if(!self::$mimetypes){
    				self::$mimetypes=include('mimetypes.list.php');
    			}
    			
    			//$extension = strtolower(strrchr(basename($strLogicalFileName), "."));
    			//$extension = substr($extension, 1);//remove leading .
    			
    			$mimeType = (isset(self::$mimetypes[$extension])) ? self::$mimetypes[$extension] : 'application/octet-stream';
    		}
    		return $mimeType;
    	}
    }
    
    /**
     * Determine if a given program is found in the search PATH
     *
     * @param  string  program name
     * @param  string  optional search path, defaults to $PATH
     * @return bool    true if executable program found in path
     */
    public static function canExecute($name, $path = false){
    	// path defaults to PATH from environment if not set
    	if ($path === false) {
    		$path = getenv("PATH");
    	}
    	// check method depends on operating system
    	if (!strncmp(PHP_OS, "WIN", 3)) {
    		// on Windows an appropriate COM or EXE file needs to exist
    		$exts = array(".exe", ".com");
    		$check_fn = "file_exists";
    	} else {
    		// anywhere else we look for an executable file of that name
    		$exts = array("");
    		$check_fn = "is_executable";
    	}
    	// Default check will be done with $path directories :
    	$dirs = explode(PATH_SEPARATOR, $path);
    	// WARNING : We have to check if open_basedir is enabled :
    	$obd = ini_get('open_basedir');
    	if($obd != "none")
    		$obd_values = explode(PATH_SEPARATOR, $obd);
    	if(count($obd_values) > 0 and $obd_values[0])
    	{
    		// open_basedir is in effect !
    		// We need to check if the program is in one of these dirs :
    		$dirs = $obd_values;
    	}
    	foreach($dirs as $dir)
    	{
    		foreach($exts as $ext)
    		{
    			if($check_fn("$dir/$name".$ext))
    				return true;
    		}
    	}
    	return false;
    }
    
    /**
     * Construct a struct that specifies an error
     * 
     * @param string $strError the error message
     * @return array the error struct
     */
    protected function error($strError) {
    	$arrReturn = array();
    	$arrReturn['result'] = 'error';
    	$arrReturn['details'] = $strError;
    	return $arrReturn;
    }
}

?>
<?php
/**
 * Class for fileserver access
 *
 */
class Atom_Files {
	static $tmpFiles=array();

	/**
	* get the content of a directory
	* @param dir $directory
	*/
	public static function getDirectoryContent($directory){
		if(strpos($directory,Atom::$CONFIG_DATADIRECTORY)===0){
			$directory=substr($directory,strlen(Atom::$CONFIG_DATADIRECTORY));
		}
		$filesfound=true;
		$content=array();
		$dirs=array();
		$file=array();
		$files=array();
		if(Atom_Filesystem::is_dir($directory)) {
			if ($dh = Atom_Filesystem::opendir($directory)) {
			while (($filename = readdir($dh)) !== false) {
				if($filename<>'.' and $filename<>'..' and substr($filename,0,1)!='.'){
					$file=array();
					$filesfound=true;
					$file['name']=$filename;
					$file['directory']=$directory;
					$stat=Atom_Filesystem::stat($directory.'/'.$filename);
					$file=array_merge($file,$stat);
					$file['size']=Atom_Filesystem::filesize($directory.'/'.$filename);
					$file['mime']=Atom_Files::getMimeType($directory .'/'. $filename);
					$file['readable']=Atom_Filesystem::is_readable($directory .'/'. $filename);
					$file['writeable']=Atom_Filesystem::is_writeable($directory .'/'. $filename);
					$file['type']=Atom_Filesystem::filetype($directory .'/'. $filename);
					if($file['type']=='dir'){
						$dirs[$file['name']]=$file;
					}else{
						$files[$file['name']]=$file;
					}
				}
			}
			closedir($dh);
			}
		}
		uksort($dirs, "strnatcasecmp");
		uksort($files, "strnatcasecmp");
		$content=array_merge($dirs,$files);
		if($filesfound){
			return $content;
		}else{
			return false;
		}
	}



	/**
	* return the content of a file or return a zip file containning multiply files
	*
	* @param dir  $dir
	* @param file $file ; seperated list of files to download
	*/
	public static function get($dir,$files){
		if(strpos($files,';')){
			$files=explode(';',$files);
		}

		if(is_array($files)){
			$zip = new ZipArchive();
			$filename = get_temp_dir()."/ownCloud.zip";
			if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
				exit("cannot open <$filename>\n");
			}
			foreach($files as $file){
				$file=$dir.'/'.$file;
				if(Atom_Filesystem::is_file($file)){
					$tmpFile=Atom_Filesystem::toTmpFile($file);
					self::$tmpFiles[]=$tmpFile;
					$zip->addFile($tmpFile,basename($file));
				}elseif(Atom_Filesystem::is_dir($file)){
					self::zipAddDir($file,$zip);
				}
			}
			$zip->close();
		}elseif(Atom_Filesystem::is_dir($dir.'/'.$files)){
			$zip = new ZipArchive();
			$filename = get_temp_dir()."/ownCloud.zip";
			if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
				exit("cannot open <$filename>\n");
			}
			$file=$dir.'/'.$files;
			self::zipAddDir($file,$zip);
			$zip->close();
		}else{
			$zip=false;
			$filename=$dir.'/'.$files;
		}
		if($zip or Atom_Filesystem::is_readable($filename)){
			header('Content-Disposition: attachment; filename="'.basename($filename).'"');
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			if($zip){
				header('Content-Type: application/zip');
				header('Content-Length: ' . filesize($filename));
			}else{
				header('Content-Type: ' . Atom_Filesystem::getMimeType($filename));
				header('Content-Length: ' . Atom_Filesystem::filesize($filename));
			}
		}elseif($zip or !Atom_Filesystem::file_exists($filename)){
			header("HTTP/1.0 404 Not Found");
			$tmpl = new Atom_Template( '', '404', 'guest' );
			$tmpl->assign('file',$filename);
			$tmpl->printPage();
// 			die('404 Not Found');
		}else{
			header("HTTP/1.0 403 Forbidden");
			die('403 Forbidden');
		}
		@ob_end_clean();
		if($zip){
			readfile($filename);
			unlink($filename);
		}else{
			Atom_Filesystem::readfile($filename);
		}
		foreach(self::$tmpFiles as $tmpFile){
			if(file_exists($tmpFile) and is_file($tmpFile)){
				unlink($tmpFile);
			}
		}
	}

	public static function zipAddDir($dir,$zip,$internalDir=''){
		$dirname=basename($dir);
		$zip->addEmptyDir($internalDir.$dirname);
		$internalDir.=$dirname.='/';
		$files=Atom_Files::getdirectorycontent($dir);
		foreach($files as $file){
			$filename=$file['name'];
			$file=$dir.'/'.$filename;
			if(Atom_Filesystem::is_file($file)){
				$tmpFile=Atom_Filesystem::toTmpFile($file);
				Atom_Files::$tmpFiles[]=$tmpFile;
				$zip->addFile($tmpFile,$internalDir.$filename);
			}elseif(Atom_Filesystem::is_dir($file)){
				self::zipAddDir($file,$zip,$internalDir);
			}
		}
	}
	/**
	* move a file or folder
	*
	* @param dir  $sourceDir
	* @param file $source
	* @param dir  $targetDir
	* @param file $target
	*/
	public static function move($sourceDir,$source,$targetDir,$target){
		if(Atom_User::isLoggedIn()){
			$targetFile=$targetDir.'/'.$target;
			$sourceFile=$sourceDir.'/'.$source;
			return Atom_Filesystem::rename($sourceFile,$targetFile);
		}
	}

	/**
	* copy a file or folder
	*
	* @param dir  $sourceDir
	* @param file $source
	* @param dir  $targetDir
	* @param file $target
	*/
	public static function copy($sourceDir,$source,$targetDir,$target){
		if(Atom_User::isLoggedIn()){
			$targetFile=$targetDir.'/'.$target;
			$sourceFile=$sourceDir.'/'.$source;
			return Atom_Filesystem::copy($sourceFile,$targetFile);
		}
	}

	/**
	* create a new file or folder
	*
	* @param dir  $dir
	* @param file $name
	* @param type $type
	*/
	public static function newFile($dir,$name,$type){
		if(Atom_User::isLoggedIn()){
			$file=$dir.'/'.$name;
			if($type=='dir'){
				return Atom_Filesystem::mkdir($file);
			}elseif($type=='file'){
				$fileHandle=Atom_Filesystem::fopen($file, 'w');
				if($fileHandle){
					fclose($fileHandle);
					return true;
				}else{
					return false;
				}
			}
		}
	}

	/**
	* deletes a file or folder
	*
	* @param dir  $dir
	* @param file $name
	*/
	public static function delete($dir,$file){
		if(Atom_User::isLoggedIn()){
			$file=$dir.'/'.$file;
			return Atom_Filesystem::unlink($file);
		}
	}

	/**
	* try to detect the mime type of a file
	*
	* @param  string  path
	* @return string  guessed mime type
	*/
	static function getMimeType($path){
		return Atom_Filesystem::getMimeType($path);
	}

	/**
	* get a file tree
	*
	* @param  string  path
	* @return array
	*/
	static function getTree($path){
		return Atom_Filesystem::getTree($path);
	}

	/**
	* pull a file from a remote server
	* @param  string  source
	* @param  string  token
	* @param  string  dir
	* @param  string  file
	* @return string  guessed mime type
	*/
	static function pull($source,$token,$dir,$file){
		$tmpfile=tempnam(get_temp_dir(),'remoteCloudFile');
		$fp=fopen($tmpfile,'w+');
		$url=$source.="/files/pull.php?token=$token";
		$ch=curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_exec($ch);
		fclose($fp);
		$info=curl_getinfo($ch);
		$httpCode=$info['http_code'];
		curl_close($ch);
		if($httpCode==200 or $httpCode==0){
			Atom_Filesystem::fromTmpFile($tmpfile,$dir.'/'.$file);
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * set the maximum upload size limit for apache hosts using .htaccess
	 * @param int size filesisze in bytes
	 */
	static function setUploadLimit($size){
		$size=Atom_Helper::humanFileSize($size);
		$size=substr($size,0,-1);//strip the B
		$size=str_replace(' ','',$size); //remove the space between the size and the postfix
		$content = "ErrorDocument 404 /".Atom::$WEBROOT."/core/templates/404.php\n";//custom 404 error page
		$content.= "php_value upload_max_filesize $size\n";//upload limit
		$content.= "php_value post_max_size $size\n";
		$content.= "SetEnv htaccessWorking true\n";
		$content.= "Options -Indexes\n";
		@file_put_contents(Atom::$SERVERROOT.'/.htaccess', $content); //supress errors in case we don't have permissions for it
	}
}

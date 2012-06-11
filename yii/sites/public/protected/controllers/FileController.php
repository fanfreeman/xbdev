<?php

class FileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/atom';

	/**	
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules()
		{
			return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
					'actions'=>array('index','indexajax','ListDirectoryContent','GetDirectoryContentUpdates','DirectoryInfo','FileInfo','ShareItems','ShareDirectory','ShareFile','GetDirectoryUsers','GetFileUsers','SetDirectoryPermissions','SetFilePermissions','Download','CreateDirectory','UploadFile','GetProgress','MoveDirectory','MoveFile','RemoveDirectory','RemoveFile','CombineFiles','RenameFile', 'RemoveItems','RenameDirectory','GetSharingUsers','GetSharedItems','GetAllFiles','GetFile','GetMyFiles','Headers','AddComment','GetComments'),
					'users'=>array('@'),
				),
				array('deny',  // deny all users
					'users'=>array('*'),
				),
			);
		}
	
	/**
	 * The main files app page
	 */
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionIndexajax()
	{
		$callback['success'] = true;	
		$callback['html'] = $this->renderPartial('index','',true);
		echo json_encode($callback);	
	}
	
	/**
	 * List the contents of a directory (GET)
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['did'] the directory id of the directory to list
	 * @return array the directory's name, subdirectories and files
	 */
	public function actionListDirectoryContent() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
			$intDirId = isset($_GET['did']) ? $_GET['did'] : 0; // default to home directory
	
			$objFileSystem = new FileSystem();
			$result = $objFileSystem->readDirectoryContent($intUserId, $intDirId);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		} else {
			echo $strCallback . '('.json_encode('Error: no user id specified.').')';
		}
	}
	
	/**
	 * Given a list of directory content, get the list of what is
	 * added, what is removed, and what has changed name
	 * @param string $_POST['content'] the current content the front end has
	 * @return array the updates, in the form of:
	 * directories['added'] directories['removed'] directories['renamed']
	 * files['added'] files['removed'] files['renamed']
	 */
	public function actionGetDirectoryContentUpdates() {
		$strCallback = isset($_POST['callback']) ? $_POST['callback'] : 'parseResponse';
		$strDirectories = isset($_POST['directories']) ? $_POST['directories'] : '';
		$strFiles = isset($_POST['files']) ? $_POST['files'] : '';
		
		$objFileSystem = new FileSystem();
		$result = $objFileSystem->getDirectoryContentUpdates($strDirectories, $strFiles);
		//echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		//echo htmlspecialchars($strCallback . '('. $strFiles . ')', ENT_NOQUOTES);
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
	}
	
	/**
	 * Get detailed info of a directory (GET)
	 * @param integer $_GET['did'] the directory id
	 * @return array the directory name, created and updated dates
	 */
	public function actionDirectoryInfo() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['did']) && $_GET['did'] != '') {
			$intDirectoryId = $_GET['did'];
	
			$objFileSystem = new FileSystem();
			$result = $objFileSystem->getDirectoryInfo($intDirectoryId);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		} else {
			echo $strCallback . '('.json_encode('Error: no directory id specified.').')';
		}
	}
	
	/**
	 * Get detailed info of a file (GET)
	 * @param integer $_GET['fid'] the file id
	 * @return array the file name, extension, size, created and updated dates
	 */
	public function actionFileInfo() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['fid']) && $_GET['fid'] != '') {
			$intFileId = $_GET['fid'];
	
			$objFileSystem = new FileSystem();
			$result = $objFileSystem->getFileInfo($intFileId);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		} else {
			echo $strCallback . '('. json_encode('Error: no file id specified.').')';
		}
	}
	
	/**
	 * Share any number of directories and files with a number of users
	 * @param string $_GET['directories'] the list of directories to share, in the form of directory ids separated by underscores
	 * @param string $_GET['files'] the list of files to share, in the form of file ids separated by underscores
	 * @param string $_GET['users'] the list of users to share with, in the form of user ids separated by underscores (e.g. 2_6_15)
	 */
	public function actionShareItems() {
		$intUserId = Yii::app()->user->id;
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		$objFileSystem = new FileSystem();
		$boolNoErrors = true;
		
		if (isset($_GET['users'])) {
			$strUsers = $_GET['users'];
			$arrUsers = explode('_', $strUsers);
			if (sizeof($arrUsers) > 0) {
		
				if (isset($_GET['directories'])) {
					$strDirs = $_GET['directories'];
					$arrDirs = explode('_', $strDirs);
					if (sizeof($arrDirs) > 0) {
						foreach ($arrDirs as $strDirId) {
							if (strlen($strDirId) <= 0) continue;
							$intDirId = (int)$strDirId;
							if (is_int($intDirId)) {
								$result = $objFileSystem->shareDirectory($intUserId, $intDirId, $arrUsers);
								if ($result['success'] != true) {
									echo htmlspecialchars($strCallback . '('. json_encode(array('error' => $result['error'])) . ')', ENT_NOQUOTES);
									$boolNoErrors = false;
								}
							} else {
								$result = array('error' => 'directory id list error, must be integers');
								echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
								$boolNoErrors = false;
							}
						}
					}
				}
				
				if (isset($_GET['files'])) {
					$strFiles = $_GET['files'];
					$arrFiles = explode('_', $strFiles);
					if (sizeof($arrFiles) > 0) {
						foreach ($arrFiles as $strFileId) {
							if (strlen($strFileId) <= 0) continue;
							$intFileId = (int)$strFileId;
							if (is_int($intFileId)) {
								$result = $objFileSystem->shareFile($intUserId, $intFileId, $arrUsers);
								if ($result['success'] != true) {
									htmlspecialchars($strCallback . '('. json_encode(array('error' => $result['error'])) . ')', ENT_NOQUOTES);
									$boolNoErrors = false;
								}
							} else {
								$result = array('error' => 'file id list error, must be integers');
								echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
								$boolNoErrors = false;
							}
						}
					}
				}
				
			} else { // if (sizeof($arrUsers) > 0) {
				$result = array('error' => 'too few users specified');
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				$boolNoErrors = false;
			}
		} else { // if (isset($_GET['users'])) {
			$result = array('error' => 'invalid list of users');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			$boolNoErrors = false;
		}
		
		if ($boolNoErrors == true) {
			$result = array('success' => true);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Share a directory with a list of users (GET)
	 * @param integer $_GET['uid'] the user sharing the directory
	 * @param integer $_GET['did'] the directory to share
	 * @param string $_GET['users'] the list of users to share with, in the form of user ids separated by underscores (e.g. 2_6_15)
	 */
	public function actionShareDirectory() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['did']) && $_GET['did'] != '') {
				$intDirectoryId = $_GET['did'];
	
				if(isset($_GET['users'])) {
					$strUsers = $_GET['users'];
					$arrUsers = explode('_', $strUsers);
	
					if (sizeof($arrUsers) > 0) {
						$objFileSystem = new FileSystem();
						$result = $objFileSystem->shareDirectory($intUserId, $intDirectoryId, $arrUsers);
						echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
					} else {
						$result = array('error' => 'too few users specified');
						echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
					}
				} else {
					$result = array('error' => 'invalid list of users');
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				}
			} else {
				$result = array('error' => 'no directory id specified');
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			}
		} else {
			$result = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Share a file with a list of users (GET)
	 * @param integer $_GET['uid'] the user sharing the file
	 * @param integer $_GET['fid'] the file to share
	 * @param string $_GET['users'] the list of users to share with, in the form of user ids separated by underscores (e.g. 2_6_15)
	 */
	public function actionShareFile() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['fid']) && $_GET['fid'] != '') {
				$intFileId = $_GET['fid'];
	
				if(isset($_GET['users'])) {
					$strUsers = $_GET['users'];
					$arrUsers = explode('_', $strUsers);
					if (sizeof($arrUsers) > 0) {
						$objFileSystem = new FileSystem();
						$result = $objFileSystem->shareFile($intUserId, $intFileId, $arrUsers);
						echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
					} else {
						$result = array('error' => 'too few users specified');
						echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
					}
				} else {
					$result = array('error' => 'invalid list of users');
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				}
			} else {
				$result = array('error' => 'no file id specified');
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			}
		} else {
			$result = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Return the list of users who have access to the specified directory
	 * @param integer $_GET['did']
	 * @return jsonp the list of users
	 */
	public function actionGetDirectoryUsers() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['did']) && $_GET['did'] != '') {
			$intDirectoryId = $_GET['did'];
			$objFileSystem = new FileSystem();
			$result = $objFileSystem->getDirectoryUsers($intDirectoryId);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		} else {
			$result = array('error' => 'no directory id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Return the list of users who have access to the specified file
	 * @param integer $_GET['fid']
	 * @return jsonp the list of users
	 */
	public function actionGetFileUsers() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['fid']) && $_GET['fid'] != '') {
			$intFileId = $_GET['fid'];
			$objFileSystem = new FileSystem();
			$result = $objFileSystem->getFileUsers($intFileId);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		} else {
			$result = array('error' => 'no file id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Sets the specified user's permissions to the specified directory
	 * @param integer $_GET['uid'] the user
	 * @param integer $_GET['did'] the directory
	 * @param integer $_GET['p'] the permission code (0,1,2,3,4,5)
	 */
	public function actionSetDirectoryPermissions() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['did']) && $_GET['did'] != '') {
				$intDirectoryId = $_GET['did'];
	
				if (isset($_GET['p']) && $_GET['p'] != '') {
					$intPermissionCode = $_GET['p'];
	
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->setDirectoryPermissions($intUserId, $intDirectoryId, $intPermissionCode);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					$result = array('error' => 'no permission code specified');
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				}
			} else {
				$result = array('error' => 'no directory id specified');
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			}
		} else {
			$result = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Sets the specified user's permissions to the specified file
	 * @param integer $_GET['uid'] the user
	 * @param integer $_GET['fid'] the file
	 * @param integer $_GET['p'] the permission code (0,1,2,3,4,5)
	 */
	public function actionSetFilePermissions() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['fid']) && $_GET['fid'] != '') {
				$intFileId = $_GET['fid'];
	
				if (isset($_GET['p']) && $_GET['p'] != '') {
					$intPermissionCode = $_GET['p'];
	
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->setFilePermissions($intUserId, $intFileId, $intPermissionCode);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					$result = array('error' => 'no permission code specified');
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				}
			} else {
				$result = array('error' => 'no file id specified');
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			}
		} else {
			$result = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Download a number of directories and files (GET)
	 * @param integer $_GET['dids'] the directory ids of the directories to download
	 * @param integer $_GET['fids'] the file index ids of the files to download
	 */
	public function actionDownload() {
		$intUserId = Yii::app()->user->id;
		
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (empty($_GET['fids']) && empty($_GET['dids'])) {
			$result = array('error' => 'nothing to download');
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			exit;
		}
		
		$strDirectoryIds = '';
		if (isset($_GET['dids']) && $_GET['dids'] != '') {
			$strDirectoryIds = $_GET['dids'];
		}
		$strFileIds = '';
		if (isset($_GET['fids']) && $_GET['fids'] != '') {
			$strFileIds = $_GET['fids'];
		}
		
		$objFileSystem = new FileSystem();
		$result = $objFileSystem->download($intUserId, $strDirectoryIds, $strFileIds);
		if (is_array($result)) {
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
		
	}
	
	/**
	 * Create a new directory (GET)
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['pdid'] the parent directory id
	 * @param string $_GET['dir_name'] the name of the new directory
	 * @return integer newDirId the id of the newly created directory
	 */
	public function actionCreateDirectory() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
			if (isset($_GET['pdid'])) {
				$intParentDirectoryId = $_GET['pdid'];
				if (isset($_GET['dir_name'])) {
					$strNewDirName = $_GET['dir_name'];
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->addDirectory($intUserId, $intParentDirectoryId, $strNewDirName);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					echo $strCallback . '('.json_encode('Error: new directory name not specified.').')';
				}
			} else {
				echo $strCallback . '('.json_encode('Error: parent directory ID not specified.').')';
			}
		} else {
			echo $strCallback . '('.json_encode('Error: no user id specified.').')';
		}
	}
	
	/**
	 * Upload a file (POST)
	 * @param binary $_FILES['uploaded_file'] the file to upload
	 * @param integer $_FILES['curr_dir_id'] the directory to upload to
	 * @return integer newFileId the id of the newly uploaded file
	 */
	public function actionUploadFile() {
		error_reporting(E_ALL | E_STRICT);
		ini_set('display_errors', 1);
	
		$strCallback = isset($_POST['callback']) ? $_POST['callback'] : 'parseResponse';
	
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['did']) && $_GET['did'] != '') {
				$intDirId = $_GET['did'];
			} else {
				$intDirId = 0;
			}
	
			$objFileSystem = new FileSystem();
	
			// list of valid extensions, ex. array("jpeg", "xml", "bmp")
			$arrAllowedExtensions = array(); // allow all extensions
	
			// max file size in bytes
			$intSizeLimit = 2000 * 1024 * 1024; // max file size 2000M
	
			$arrResult = $objFileSystem->handleUpload($intUserId, $intDirId, $arrAllowedExtensions, $intSizeLimit);
			echo htmlspecialchars(json_encode($arrResult), ENT_NOQUOTES); // to pass data through iframe we need to encode all html tags
		} else {
			$result = array('error' => 'user id to upload for not specified');
			echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		}
	}
	
	/**
	 * Get the current upload progress
	 * This is used to display an upload progress bar
	 * @param string $_GET['progress_key'] the unique identifier of the upload
	 * @return a json object containing total file size and uploaded size
	 */
	public function actionGetProgress() {
		if($_SERVER['REQUEST_METHOD']=='GET') {
			$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
			if(isset($_GET['progress_key'])) {
				$status = apc_fetch('upload_'.$_GET['progress_key']);
				echo $strCallback . '(' . json_encode(
						array(
								'current' => $status['current'],
								'total' => $status['total']
						)
				) . ')';
			}
		} else {
			echo $strCallback . '('.json_encode('Error: only accept GET.').')';
		}
	}
	
	/**
	 * NOTE: THIS FUNCTION IS NOT IMPLEMENTED BECAUSE WE CURRENTLY ONLY SUPPORT TWO LEVELS OF DIRECTORIES
	 * Move a directory to another location (GET)
	 * @param integer $_GET['did'] the directory to move
	 * @param integer $_GET['tpdid'] the target parent directory id
	 */
	public function actionMoveDirectory() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['did'])) {
			$intDirectoryId = $_GET['did'];
			if (isset($_GET['tpdid'])) {
				$intTargetDirectoryId = $_GET['tpdid'];
				$objFileSystem = new FileSystem();
				$result = $objFileSystem->moveDirectory($intDirectoryId, $intTargetDirectoryId);
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			} else {
				echo $strCallback . '('.json_encode('Error: no target parent directory specified.').')';
			}
		} else {
			echo $strCallback . '('.json_encode('Error: no directory specified.').')';
		}
	}
	
	/**
	 * Move a file to another location (GET)
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['fid'] the file to move
	 * @param integer $_GET['tpdid'] the target parent directory id
	 */
	public function actionMoveFile() {
		self::sendHeaders();
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['fid'])) {
				$intFileId = $_GET['fid'];
	
				if (isset($_GET['tpdid'])) {
					$intTargetDirectoryId = $_GET['tpdid'];
	
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->moveFile($intUserId, $intFileId, $intTargetDirectoryId);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					echo $strCallback . '('.json_encode('Error: no target parent directory specified.').')';
				}
			} else {
				echo $strCallback . '('.json_encode('Error: no file specified.').')';
			}
		} else {
			$arrResult = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Remove a list of files and directories
	 * @param integer $_GET['directories'] the list of directories to remove, in the form of directory ids separated by underscores
	 * @param integer $_GET['files'] the list of files to remove, in the form of file ids separated by underscores
	 */
	public function actionRemoveItems() {
		$intUserId = Yii::app()->user->id;
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		$objFileSystem = new FileSystem();
		$boolNoErrors = true;
		
		if (isset($_GET['directories'])) {
			$strDirs = $_GET['directories'];
			$arrDirs = explode('_', $strDirs);
			if (sizeof($arrDirs) > 0) {
				foreach ($arrDirs as $strDirId) {
					if (strlen($strDirId) <= 0) continue;
					$intDirId = (int)$strDirId;
					if (is_int($intDirId)) {
						$result = $objFileSystem->removeDirectoryForUser($intUserId, $intDirId);
						if (!empty($result['error'])) {
							echo htmlspecialchars($strCallback . '('. json_encode(array('error' => $result['error'])) . ')', ENT_NOQUOTES);
							$boolNoErrors = false;
						}
					} else {
						$result = array('error' => 'directory id list error, must be integers');
						echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
						$boolNoErrors = false;
					}
				}
			}
		}
		
		if (isset($_GET['files'])) {
			$strFiles = $_GET['files'];
			$arrFiles = explode('_', $strFiles);
			if (sizeof($arrFiles) > 0) {
				foreach ($arrFiles as $strFileId) {
					if (strlen($strFileId) <= 0) continue;
					$intFileId = (int)$strFileId;
					if (is_int($intFileId)) {
						$result = $objFileSystem->removeFile($intUserId, $intFileId);
						if ($result['success'] != true) {
							htmlspecialchars($strCallback . '('. json_encode(array('error' => $result['error'])) . ')', ENT_NOQUOTES);
							$boolNoErrors = false;
						}
					} else {
						$result = array('error' => 'file id list error, must be integers');
						echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
						$boolNoErrors = false;
					}
				}
			}
		}
		
		if ($boolNoErrors == true) {
			$result = array('success' => true);
			echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Remove a directory recursively, all contents will also be removed
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['did'] the directory to remove
	 */
	public function actionRemoveDirectory() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['did'])) {
			$intDirectoryId = $_GET['did'];
			if (isset($_GET['uid'])) {
				$intUserId = $_GET['uid'];
				$objFileSystem = new FileSystem();
				$result = $objFileSystem->removeDirectoryForUser($intUserId, $intDirectoryId);
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			} else {
				echo htmlspecialchars($strCallback . '('. json_encode(array("error" => "no user specified")) . ')', ENT_NOQUOTES);
			}
		} else {
			echo htmlspecialchars($strCallback . '('. json_encode(array("error" => "no directory specified")) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Remove a file
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['fid'] the file to remove
	 */
	public function actionRemoveFile() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['fid'])) {
				$intFileId = $_GET['fid'];
				$objFileSystem = new FileSystem();
				$result = $objFileSystem->removeFile($intUserId, $intFileId);
				echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
			} else {
				echo $strCallback . '('.json_encode('Error: no file specified.').')';
			}
		} else {
			$arrResult = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Combine two files, creating a new directory with
	 * a default name, containing these two files
	 * The directory is created at the same location as the second file
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['fid_first'] the first file
	 * @param integer $_GET['fid_second'] the second file
	 * @return integer newDirectoryId the id of the newly generated directory
	 */
	public function actionCombineFiles() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
			if (isset($_GET['fid_first'])) {
				$intFileIdFirst = $_GET['fid_first'];
				if (isset($_GET['fid_second'])) {
					$intFileIdSecond = $_GET['fid_second'];
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->combineFiles($intUserId, $intFileIdFirst, $intFileIdSecond);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					echo $strCallback . '('.json_encode('Error: second file not specified.').')';
				}
			} else {
				echo $strCallback . '('.json_encode('Error: first file not specified.').')';
			}
		} else {
			echo $strCallback . '('.json_encode('Error: no user id specified.').')';
		}
	}
	
	/**
	 * Rename a file (GET)
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['fid'] the file to rename
	 * @param string $_GET['name'] the new name to give to the file
	 */
	public function actionRenameFile() {
		self::sendHeaders();
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['fid'])) {
				$intFileId = $_GET['fid'];
	
				if (isset($_GET['name'])) {
					$strNewName = $_GET['name'];
	
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->renameFile($intUserId, $intFileId, $strNewName);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					echo $strCallback . '('.json_encode('Error: no new file name specified.').')';
				}
			} else {
				echo $strCallback . '('.json_encode('Error: no file specified.').')';
			}
		} else {
			$arrResult = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Rename a directory (GET)
	 * @param integer $_GET['uid'] the user id
	 * @param integer $_GET['did'] the directory to rename
	 * @param string $_GET['name'] the new name to give to the directory
	 */
	public function actionRenameDirectory() {
		self::sendHeaders();
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
	
			if (isset($_GET['did'])) {
				$intDirectoryId = $_GET['did'];
	
				if (isset($_GET['name'])) {
					$strNewName = $_GET['name'];
	
					$objFileSystem = new FileSystem();
					$result = $objFileSystem->renameDirectory($intUserId, $intDirectoryId, $strNewName);
					echo htmlspecialchars($strCallback . '('. json_encode($result) . ')', ENT_NOQUOTES);
				} else {
					echo $strCallback . '('.json_encode('Error: no new directory name specified.').')';
				}
			} else {
				echo $strCallback . '('.json_encode('Error: no directory specified.').')';
			}
		} else {
			echo $strCallback . '('.json_encode('Error: no user id specified.').')';
		}
	}
	
	/**
	 * Get the list of users who are sharing files with the specified user
	 * @param integer $_GET['uid'] the specified user
	 * @return jsonp a list of key-value pairs, where the key is the user id, and the value is the number of files and directories shared between them
	 */
	public function actionGetSharingUsers() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
			$objFileSystem = new FileSystem();
			$arrResult = $objFileSystem->getSharingUsers($intUserId);
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		} else {
			$arrResult = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
     * Read info of all files from db in the form of an array of arrays
     * @return jsonp the list of all files
     */
	public function actionGetAllFiles() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		$objFileSystem = new FileSystem();
		$arrResult = $objFileSystem->getAllFiles();
		echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
	}
	
	/**
	 * Read info of a file from db in the form of an array of arrays
	 * @param integer $GET_['fid'] the file id
	 * @return jsonp the specified file
	 */
	public function actionGetFile() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['fid']) && $_GET['fid'] != '') {
			$intFileId = $_GET['fid'];
			$objFileSystem = new FileSystem();
			$arrResult = $objFileSystem->getFile($intFileId);
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		} else {
			$arrResult = array('error' => 'no file id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Get the list of shared directories and files given two users ids
	 * @param integer $_GET['uid1'] the first user
	 * @param integer $_GET['uid2'] the second user
	 * @return jsonp the list of shared directories and files
	 */
	public function actionGetSharedItems() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid1']) && $_GET['uid1'] != '') {
			$intUserId1 = $_GET['uid1'];
	
			if (isset($_GET['uid2']) && $_GET['uid2'] != '') {
				$intUserId2 = $_GET['uid2'];
	
				$objFileSystem = new FileSystem();
				$arrResult = $objFileSystem->getSharedItems($intUserId1, $intUserId2);
				echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
			} else {
				$arrResult = array('error' => 'second user id not specified');
				echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
			}
		} else {
			$arrResult = array('error' => 'first user id not specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Get only the user's own files, not files shared with the user
	 * @param integer $_GET['uid'] the specified user
	 * @return jsonp the list of files
	 */
	public function actionGetMyFiles() {
		$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
		if (isset($_GET['uid']) && $_GET['uid'] != '') {
			$intUserId = $_GET['uid'];
			$objFileSystem = new FileSystem();
			$arrResult = $objFileSystem->getMyFiles($intUserId);
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		} else {
			$arrResult = array('error' => 'no user id specified');
			echo htmlspecialchars($strCallback . '('. json_encode($arrResult) . ')', ENT_NOQUOTES);
		}
	}
	
	/**
	 * Sends prespecified headers to the client
	 */
	protected function sendHeaders() {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		if(array_key_exists('HTTP_ACCESS_CONTROL_REQUEST_HEADERS', $_SERVER)) {
			header('Access-Control-Allow-Headers: '
					. $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
		} else {
			header('Access-Control-Allow-Headers: *');
		}
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
	}


	/**
     * 获取file评论列表
	 * @param integer $_GET['intfileId'] the fileid
     * return $callback['success']
     *             $callback['commentList']
     */
     	public function actionGetComments() {	 
             $strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
             $callback['success'] = false;
             $callback['commentList'] = 'error';
             if (isset($_GET['intfileId']) && $_GET['intfileId'] != ''&&intval($_GET['intfileId'])) {
                  $intfileId = intval( $_GET['intfileId']);
                      $callback['success'] = true;
                      $temp= bizFilecomments::getComments($intfileId);
                      $callback['commentList']=  $temp['data'];
                      $callback['commentNum']=  $temp['num'];
		     }
            echo htmlspecialchars($strCallback . '('. json_encode($callback) . ')', ENT_NOQUOTES);
	    }
	

	/**
     * 添加file评论
	 * @param integer $_GET['intfileId'] the fileid
	 * @param string $_GET['strContent'] the filecomment content
     * return $callback['success']
     *             $callback['commentList']
     */

	    public function actionAddComment(){	    
			$strCallback = isset($_GET['callback']) ? $_GET['callback'] : 'parseResponse';
             $callback['success'] = false;
             $callback['commentList']= 'error';
             if (isset($_GET['intfileId']) && $_GET['intfileId'] != ''&&isset($_GET['strContent'])&&$_GET['strContent']!='') {
                 $intUserId = Yii::app()->user->id;
                 $intfileId = intval( $_GET['intfileId']);
                 $strContent = strval($_GET['strContent']);
                 if($intfileId = bizFilecomments::addComment($intUserId, $intfileId, $strContent)){
                      $callback['success'] = true;
                      $temp= bizFilecomments::getComments($intfileId);
                      $callback['commentList']=  $temp['data'];
                      $callback['commentNum']=  $temp['num'];
		         }
            }
			echo htmlspecialchars($strCallback . '('. json_encode($callback) . ')', ENT_NOQUOTES);
	   }
}


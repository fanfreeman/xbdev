<?php

class SiteController extends CController
{
	
	
	/*
	 * TEST
	 */
	public function actionIndex() {
		error_reporting(E_ALL | E_STRICT);
		ini_set('display_errors', 1);
		
		$boolUploaded = false;
		
		$objFileSystem = new FileSystem();
		
		// get current directory id
		if (isset($_POST['curr_dir_id'])) {
			$intDirId = $_POST['curr_dir_id'];
		} elseif (isset($_GET['did'])) {
			$intDirId = $_GET['did'];
		} else {
			$intDirId = 1;
		}
		
		// check for directory creation
		if (isset($_POST['dir_name'])) {
			if(!$boolResult = $objFileSystem->addDirectory(1, $intDirId, $_POST['dir_name'])) {
				echo 'Error creating directory!<br />';
			}
		}
		
		// check for file upload
		if (isset($_FILES['uploaded_file'])) {
			$file = $_FILES['uploaded_file'];
			$intDirId = isset($_FILES['curr_dir_id']) ? $_FILES['curr_dir_id'] : 1;
			if ($intFileId = $objFileSystem->addFile($intDirId, $file['tmp_name'], $file['name'])) {
				$boolUploaded = true;
			} else {
				echo 'Error uploading file!<br />';
			}
		}
		
		// list current directory content
		$arrDirContent = $objFileSystem->readDirectoryContent($intDirId, 1);
		$strDirName = isset($arrDirContent['name']) ? $arrDirContent['name'] : 'No Name';
		
		// TEST display runtime dir
		echo 'Runtime path: ' . Yii::app()->getRuntimePath() . '<br /><br />';
		
		//display current dir name
		echo 'Current directory: ' . $strDirName;
		
		//display folders
		echo '<br />';
		foreach($arrDirContent['directories'] as $arrDirectory) {
			echo 'Directory ID: ' . $arrDirectory["storage_directory_id"] . ' ';
			echo "<a href='index.php?r=site/index&did=" . $arrDirectory["storage_directory_id"] . "'>";
			echo $arrDirectory["name"];
			echo '</a>';
			echo '<br />';
		}
		
		//display files
		echo '<br />';
		foreach($arrDirContent['files'] as $arrFile) {
			echo 'File ID: ' . $arrFile["storage_file_index_id"] . ' ';
			echo "<a href='index.php?r=site/downloadFile&fid=" . $arrFile["storage_file_index_id"] . "'>";
			echo $arrFile["file_name"];
			echo '</a>';
			echo '<br />';
		}
		
		$this->render('index', array(
			'intCurrentDirId'	=> $intDirId,
			'boolUploaded'		=> $boolUploaded,
		));
	}
	
	/*
	 * NOT USED
	 */
    public function actionAdvanced()
    {
    /* test stuff
    	Yii::import('ext.Atom');
    	Yii::import('ext.Atom_Filesystem');
    	Yii::import('ext.Atom_FileProxy');
    	Yii::import('ext.Atom_Files');
    	Yii::import('ext.Atom_Config');
    	Yii::import('ext.Atom_Util');
    	Yii::import('ext.Atom_User');
    	Yii::import('ext.Atom_User_Database');
    	Yii::import('ext.Atom_User_Backend');
    	Yii::import('ext.Atom_Group');
    	Yii::import('ext.Atom_Group_Database');
    	Yii::import('ext.Atom_Group_Backend');
    	Yii::import('ext.Atom_Template');
    	Yii::import('ext.Atom_L10N');
    	Yii::import('ext.Atom_HOOK');
    	echo Atom::$SERVERROOT;
    	
    	
    	// Load the files
    	$dir = isset( $_GET['dir'] ) ? $_GET['dir'] : '';
    	// Redirect if directory does not exist
    	if(!Atom_Filesystem::is_dir($dir)) {
    		//header("Location: ".$_SERVER['PHP_SELF']."");
    		echo '<br />not right!!!!!!!!!!<br />';
    	} else echo 'RIGHT<br />';
    	
    	$this->render('index');
    */
    	
    	//$RUNTIME_NOAPPS = TRUE; //no apps, yet
    
    	Yii::import('ext.Atom');
    	Yii::import('ext.Atom_Filesystem');
    	Yii::import('ext.Atom_FileProxy');
    	Yii::import('ext.Atom_FileProxy_Quota');
    	Yii::import('ext.Atom_Files');
    	Yii::import('ext.Atom_Config');
    	Yii::import('ext.Atom_Util');
    	Yii::import('ext.Atom_User');
    	Yii::import('ext.Atom_User_Database');
    	Yii::import('ext.Atom_User_Backend');
    	Yii::import('ext.Atom_Group');
    	Yii::import('ext.Atom_Group_Database');
    	Yii::import('ext.Atom_Group_Backend');
    	Yii::import('ext.Atom_Template');
    	Yii::import('ext.Atom_L10N');
    	Yii::import('ext.Atom_Hook');
    	Yii::import('ext.Atom_Helper');
    	Yii::import('ext.Atom_DB');
    	
    	
    	// Someone is logged in :
    	if (Atom_User::isLoggedIn()) {
    		if(isset($_GET["logout"]) and ($_GET["logout"])) {
    			Atom_User::logout();
    			header("Location: ".Atom::$WEBROOT.'/');
    			exit();
    		} else {
    			Atom_Util::redirectToDefaultPage();
    		}
    	} else { // For all others cases, we display the guest page :
    		//Atom_App::loadApps();
    		$error = false;
    	
    		// remember was checked after last login
    		if(isset($_COOKIE["atom_remember_login"]) && isset($_COOKIE["atom_token"]) && isset($_COOKIE["atom_username"]) && $_COOKIE["atom_remember_login"]) {
    			if(defined("DEBUG") && DEBUG) {
    				Atom_Log::write('core','Trying to login from cookie',Atom_Log::DEBUG);
    			}
    			// confirm credentials in cookie
    			if(isset($_COOKIE['atom_token']) && Atom_User::userExists($_COOKIE['atom_username']) &&
    					Atom_Preferences::getValue($_COOKIE['atom_username'], "login", "token") == $_COOKIE['atom_token']) {
    				Atom_User::setUserId($_COOKIE['atom_username']);
    				Atom_Util::redirectToDefaultPage();
    			} else {
    				Atom_User::unsetMagicInCookie();
    			}
    		} elseif (isset($_POST["user"]) && isset($_POST['password'])) { // Someone wants to log in :
    			if(Atom_User::login($_POST["user"], $_POST["password"])) {
    				if(!empty($_POST["remember_login"])){
    					if(defined("DEBUG") && DEBUG) {
    						Atom_Log::write('core','Setting remember login to cookie',Atom_Log::DEBUG);
    					}
    					$token = md5($_POST["user"].time().$_POST['password']);
    					Atom_Preferences::setValue($_POST['user'], 'login', 'token', $token);
    					Atom_User::setMagicInCookie($_POST["user"], $token);
    				} else {
    					Atom_User::unsetMagicInCookie();
    				}
    				Atom_Util::redirectToDefaultPage();
    			} else {
    				$error = true;
    			}
    		} elseif (isset($_SERVER["PHP_AUTH_USER"]) && isset($_SERVER["PHP_AUTH_PW"])){ // The user is already authenticated using Apaches AuthType Basic... very usable in combination with LDAP
    			if (Atom_User::login($_SERVER["PHP_AUTH_USER"],$_SERVER["PHP_AUTH_PW"]))	{
    				//Atom_Log::write('core',"Logged in with HTTP Authentication",Atom_Log::DEBUG);
    				Atom_User::unsetMagicInCookie();
    				Atom_Util::redirectToDefaultPage();
    			} else {
    				$error = true;
    			}
    		}
    		// none of the above, display the login page
    		Atom_Template::printGuestPage('', 'login', array('error' => $error, 'redirect' => isset($_REQUEST['redirect_url']) ? $_REQUEST['redirect_url'] : '' ));
    		
    	}
    	
    }
    
    /*
     * NOT USED
     */
    public function actionFiles()
    {
    	Yii::import('ext.Atom');
    	Yii::import('ext.Atom_Filesystem');
    	Yii::import('ext.Atom_FileProxy');
    	Yii::import('ext.Atom_FileProxy_Quota');
    	Yii::import('ext.Atom_Files');
    	Yii::import('ext.Atom_Config');
    	Yii::import('ext.Atom_Util');
    	Yii::import('ext.Atom_User');
    	Yii::import('ext.Atom_User_Database');
    	Yii::import('ext.Atom_User_Backend');
    	Yii::import('ext.Atom_Group');
    	Yii::import('ext.Atom_Group_Database');
    	Yii::import('ext.Atom_Group_Backend');
    	Yii::import('ext.Atom_Template');
    	Yii::import('ext.Atom_L10N');
    	Yii::import('ext.Atom_Hook');
    	Yii::import('ext.Atom_Helper');
    	Yii::import('ext.Atom_DB');
    	
    	// Check if we are a user
    	//Atom_Util::checkLoggedIn();
    	
    	// Load the files we need
    	Atom_Util::addStyle( 'files_texteditor', 'style' );
    	Atom_Util::addScript( 'files_texteditor', 'editor');
    	Atom_Util::addScript( 'files_texteditor', 'aceeditor/ace');
    	Atom_Util::addStyle( "files", "files" );
    	Atom_Util::addScript( "files", "files" );
    	Atom_Util::addScript( 'files', 'filelist' );
    	Atom_Util::addScript( 'files', 'fileactions' );
    	if(!isset($_SESSION['timezone'])){
    		Atom_Util::addScript( 'files', 'timezone' );
    	}
    	//Atom_App::setActiveNavigationEntry( "files_index" );
    	// Load the files
    	$dir = isset( $_GET['dir'] ) ? $_GET['dir'] : '';
    	// Redirect if directory does not exist
    	if(!Atom_Filesystem::is_dir($dir)) {
    		echo 'oh noes'; exit;
    		header("Location: ".$_SERVER['PHP_SELF']."");
    	}
    	
    	$files = array();
    	foreach( Atom_Files::getdirectorycontent( $dir ) as $i ){
    		$i["date"] = Atom_Util::formatDate($i["mtime"] );
    		if($i['type']=='file'){
    			$fileinfo=pathinfo($i['name']);
    			$i['basename']=$fileinfo['filename'];
    			if (!empty($fileinfo['extension'])) {
    				$i['extention']='.' . $fileinfo['extension'];
    			}
    			else {
    				$i['extention']='';
    			}
    		}
    		if($i['directory']=='/'){
    			$i['directory']='';
    		}
    		$files[] = $i;
    	}
    	
    	// Make breadcrumb
    	$breadcrumb = array();
    	$pathtohere = "";
    	foreach( explode( "/", $dir ) as $i ){
    		if( $i != "" ){
    			$pathtohere .= "/".str_replace('+','%20', urlencode($i));
    			$breadcrumb[] = array( "dir" => $pathtohere, "name" => $i );
    		}
    	}
    	
    	// make breadcrumb und filelist markup
    	$list = new Atom_Template( "views", "part.list", "" );
    	$list->assign( "files", $files );
    	$list->assign( "baseURL", Atom_Helper::linkTo("files", "index.php?dir="));
    	$list->assign( "downloadURL", Atom_Helper::linkTo("files", "download.php?file="));
    	$breadcrumbNav = new Atom_Template( "views", "part.breadcrumb", "" );
    	$breadcrumbNav->assign( "breadcrumb", $breadcrumb );
    	$breadcrumbNav->assign( "baseURL", Atom_Helper::linkTo("files", "index.php?dir="));
    	
    	$upload_max_filesize = Atom_Helper::computerFileSize(ini_get('upload_max_filesize'));
    	$post_max_size = Atom_Helper::computerFileSize(ini_get('post_max_size'));
    	$maxUploadFilesize = min($upload_max_filesize, $post_max_size);
    	
    	$freeSpace=Atom_Filesystem::free_space('/');
    	$freeSpace=max($freeSpace,0);
    	$maxUploadFilesize = min($maxUploadFilesize ,$freeSpace);
    	
    	$tmpl = new Atom_Template( "views", "filesindex", "user" );
    	$tmpl->assign( "fileList", $list->fetchPage() );
    	$tmpl->assign( "breadcrumb", $breadcrumbNav->fetchPage() );
    	$tmpl->assign( 'dir', $dir);
    	$tmpl->assign( 'readonly', !Atom_Filesystem::is_writeable($dir));
    	$tmpl->assign( "files", $files );
    	$tmpl->assign( 'uploadMaxFilesize', $maxUploadFilesize);
    	$tmpl->assign( 'uploadMaxHumanFilesize', Atom_Helper::humanFileSize($maxUploadFilesize));
    	$tmpl->printPage();
    }
    
    /*
     * TEST
     */
    public function actionReadInfo($id)
    {
        $id = intval($id);
        $up = new Uploadr();
        
        if ($result = $up->readInfo($id)) {
            die(json_encode($result));
        }
        die(json_encode(array()));
    }

    /*
     * TEST
     */
    public function actionReadData($id)
    {
        $id = intval($id);
        $up = new Uploadr();

        if ($result = $up->readData($id)) {
            die($result);
        }
        die('error');
    }
}
?>
<?php
/**
 * Class for utility functions
 *
 */
class Atom_Util {
	public static $scripts=array();
	public static $styles=array();
	public static $headers=array();
	private static $fsSetup=false;

	// Can be set up
	public static function setupFS( $user = "", $root = "files" ){// configure the initial filesystem based on the configuration
		if(self::$fsSetup){//setting up the filesystem twice can only lead to trouble
			return false;
		}

		$CONFIG_DATADIRECTORY_ROOT = Atom_Config::getValue( "datadirectory", Atom::$SERVERROOT."/data" );
		$CONFIG_BACKUPDIRECTORY = Atom_Config::getValue( "backupdirectory", Atom::$SERVERROOT."/backup" );

		// Create root dir
		if(!is_dir($CONFIG_DATADIRECTORY_ROOT)){
			$success=@mkdir($CONFIG_DATADIRECTORY_ROOT);
            if(!$success) {
				$tmpl = new Atom_Template( '', 'error', 'guest' );
				$tmpl->assign('errors',array(1=>array('error'=>"Can't create data directory (".$CONFIG_DATADIRECTORY_ROOT.")",'hint'=>"You can usually fix this by giving the webserver write access to the ownCloud directory '".Atom::$SERVERROOT."' ")));
				$tmpl->printPage();
				exit;
  			}
		}

		// If we are not forced to load a specific user we load the one that is logged in
		if( $user == "" && Atom_User::isLoggedIn()){
			$user = Atom_User::getUser();
		}
		
		if( $user != "" ){ //if we aren't logged in, there is no use to set up the filesystem
			//first set up the local "root" storage
			Atom_Filesystem::mount('local',array('datadir'=>$CONFIG_DATADIRECTORY_ROOT),'/');

			Atom::$CONFIG_DATADIRECTORY = $CONFIG_DATADIRECTORY_ROOT."/$user/$root";
			if( !is_dir( Atom::$CONFIG_DATADIRECTORY )){
				mkdir( Atom::$CONFIG_DATADIRECTORY, 0755, true );
			}

			//jail the user into his "home" directory
			Atom_Filesystem::chroot("/$user/$root");
			$quotaProxy=new Atom_FileProxy_Quota();
			Atom_FileProxy::register($quotaProxy);
			self::$fsSetup=true;
		}
	}

	public static function tearDownFS(){
		Atom_Filesystem::tearDown();
		self::$fsSetup=false;
	}

	/**
	 * add a javascript file
	 *
	 * @param url  $url
	 */
	public static function addScript( $application, $file = null ){
		if( is_null( $file )){
			$file = $application;
			$application = "";
		}
		if( !empty( $application )){
			self::$scripts[] = "$application/js/$file";
		}else{
			self::$scripts[] = "js/$file";
		}
	}

	/**
	 * add a css file
	 *
	 * @param url  $url
	 */
	public static function addStyle( $application, $file = null ){
		if( is_null( $file )){
			$file = $application;
			$application = "";
		}
		if( !empty( $application )){
			self::$styles[] = "$application/css/$file";
		}else{
			self::$styles[] = "css/$file";
		}
	}

	/**
	 * @brief Add a custom element to the header
	 * @param string tag tag name of the element
	 * @param array $attributes array of attrobutes for the element
	 * @param string $text the text content for the element
	 */
	public static function addHeader( $tag, $attributes, $text=''){
		self::$headers[]=array('tag'=>$tag,'attributes'=>$attributes,'text'=>$text);
	}

       /**
         * formats a timestamp in the "right" way
         *
         * @param int timestamp $timestamp
         * @param bool dateOnly option to ommit time from the result
         */
        public static function formatDate( $timestamp,$dateOnly=false){
			if(isset($_SESSION['timezone'])){//adjust to clients timezone if we know it
				$systemTimeZone = intval(date('O'));
				$systemTimeZone=(round($systemTimeZone/100,0)*60)+($systemTimeZone%100);
				$clientTimeZone=$_SESSION['timezone']*60;
				$offset=$clientTimeZone-$systemTimeZone;
				$timestamp=$timestamp+$offset*60;
			}
			$timeformat=$dateOnly?'F j, Y':'F j, Y, H:i';
			return date($timeformat,$timestamp);
        }

	/**
	 * Shows a pagenavi widget where you can jump to different pages.
	 *
	 * @param int $pagecount
	 * @param int $page
	 * @param string $url
	 * @return Atom_Template
	 */
	public static function getPageNavi($pagecount,$page,$url) {

		$pagelinkcount=8;
		if ($pagecount>1) {
			$pagestart=$page-$pagelinkcount;
			if($pagestart<0) $pagestart=0;
			$pagestop=$page+$pagelinkcount;
			if($pagestop>$pagecount) $pagestop=$pagecount;

			$tmpl = new Atom_Template( '', 'part.pagenavi', '' );
			$tmpl->assign('page',$page);
			$tmpl->assign('pagecount',$pagecount);
			$tmpl->assign('pagestart',$pagestart);
			$tmpl->assign('pagestop',$pagestop);
			$tmpl->assign('url',$url);
			return $tmpl;
		}
	}



	/**
	 * check if the current server configuration is suitable for ownCloud
	 * @return array arrays with error messages and hints
	 */
	public static function checkServer(){
		$CONFIG_DATADIRECTORY_ROOT = Atom_Config::getValue( "datadirectory", Atom::$SERVERROOT."/data" );
		$CONFIG_BACKUPDIRECTORY = Atom_Config::getValue( "backupdirectory", Atom::$SERVERROOT."/backup" );
		$CONFIG_INSTALLED = Atom_Config::getValue( "installed", false );
		$errors=array();

		//check for database drivers
		if(!is_callable('sqlite_open') and !is_callable('mysql_connect')){
			$errors[]=array('error'=>'No database drivers (sqlite or mysql) installed.<br/>','hint'=>'');//TODO: sane hint
		}
		$CONFIG_DBTYPE = Atom_Config::getValue( "dbtype", "sqlite" );
		$CONFIG_DBNAME = Atom_Config::getValue( "dbname", "owncloud" );

		//common hint for all file permissons error messages
		$permissionsHint="Permissions can usually be fixed by giving the webserver write access to the ownCloud directory";

		//check for correct file permissions
		if(!stristr(PHP_OS, 'WIN')){
                	$permissionsModHint="Please change the permissions to 0770 so that the directory cannot be listed by other users.";
			$prems=substr(decoct(@fileperms($CONFIG_DATADIRECTORY_ROOT)),-3);
			if(substr($prems,-1)!='0'){
				Atom_Helper::chmodr($CONFIG_DATADIRECTORY_ROOT,0770);
				clearstatcache();
				$prems=substr(decoct(@fileperms($CONFIG_DATADIRECTORY_ROOT)),-3);
				if(substr($prems,2,1)!='0'){
					$errors[]=array('error'=>'Data directory ('.$CONFIG_DATADIRECTORY_ROOT.') is readable for other users<br/>','hint'=>$permissionsModHint);
				}
			}
			if( Atom_Config::getValue( "enablebackup", false )){
				$prems=substr(decoct(@fileperms($CONFIG_BACKUPDIRECTORY)),-3);
				if(substr($prems,-1)!='0'){
					Atom_Helper::chmodr($CONFIG_BACKUPDIRECTORY,0770);
					clearstatcache();
					$prems=substr(decoct(@fileperms($CONFIG_BACKUPDIRECTORY)),-3);
					if(substr($prems,2,1)!='0'){
						$errors[]=array('error'=>'Data directory ('.$CONFIG_BACKUPDIRECTORY.') is readable for other users<br/>','hint'=>$permissionsModHint);
					}
				}
			}
		}else{
			//TODO: permissions checks for windows hosts
		}
		if(is_dir($CONFIG_DATADIRECTORY_ROOT) and !is_writable($CONFIG_DATADIRECTORY_ROOT)){
			$errors[]=array('error'=>'Data directory ('.$CONFIG_DATADIRECTORY_ROOT.') not writable by ownCloud<br/>','hint'=>$permissionsHint);
		}

		// check if all required php modules are present
		if(!class_exists('ZipArchive')){
			$errors[]=array('error'=>'PHP module zip not installed.<br/>','hint'=>'Please ask your server administrator to install the module.');
		}

		if(!function_exists('mb_detect_encoding')){
			$errors[]=array('error'=>'PHP module mb multibyte not installed.<br/>','hint'=>'Please ask your server administrator to install the module.');
		}
		if(!function_exists('ctype_digit')){
			$errors[]=array('error'=>'PHP module ctype is not installed.<br/>','hint'=>'Please ask your server administrator to install the module.');
		}

		return $errors;
	}

	public static function displayLoginPage($parameters = array()){
		if(isset($_COOKIE["username"])){
			$parameters["username"] = $_COOKIE["username"];
		} else {
			$parameters["username"] = '';
		}
		Atom_Template::printGuestPage("", "login", $parameters);
	}


	/**
	* Check if the app is enabled, send json error msg if not
	*/
	public static function checkAppEnabled($app){
		if( !Atom_App::isEnabled($app)){
			header( 'Location: '.Atom_Helper::linkTo( '', 'index.php' , true));
			exit();
		}
	}

	/**
	* Check if the user is logged in, redirects to home if not
	*/
	public static function checkLoggedIn(){
		// Check if we are a user
		if( !Atom_User::isLoggedIn()){
			header( 'Location: '.Atom_Helper::linkTo( '', 'index.php' , true));
			exit();
		}
	}

	/**
	* Check if the user is a admin, redirects to home if not
	*/
	public static function checkAdminUser(){
		// Check if we are a user
		self::checkLoggedIn();
		if( !Atom_Group::inGroup( Atom_User::getUser(), 'admin' )){
			header( 'Location: '.Atom_Helper::linkTo( '', 'index.php' , true));
			exit();
		}
	}

	/**
	* Redirect to the user default page
	*/
	public static function redirectToDefaultPage(){
		if(isset($_REQUEST['redirect_url'])) {
			header( 'Location: '.$_REQUEST['redirect_url']);
		} else {
			//header( 'Location: '.Atom::$WEBROOT.'/'.Atom_Appconfig::getValue('core', 'defaultpage', 'files/index.php'));
			header( 'Location: '.Atom::$WEBROOT . '?r=site/files');
		}
		exit();
	}
}

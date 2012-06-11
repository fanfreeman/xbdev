<?php
/**
 * Class that is a namespace for all global Atom variables
 * No, we can not put this class in its own file because it is used by
 * Atom_autoload!
 */
class Atom {
	/**
	 * Assoziative array for autoloading. classname => filename
	 */
	public static $CLASSPATH = array();
	/**
	 * $_SERVER['DOCUMENTROOT'] but without symlinks
	 */
	public static $DOCUMENTROOT = '';
	/**
	 * The installation path for owncloud on the server (e.g. /srv/http/owncloud)
	 */
	public static $SERVERROOT = '';
	/**
	 * the current request path relative to the owncloud root (e.g. files/index.php)
	 */
	public static $SUBURI = '';
	/**
	 * the owncloud root path for http requests (e.g. owncloud/)
	 */
	public static $WEBROOT = '';
	/**
	 * the folder that stores that data files for the filesystem of the user (e.g. /srv/http/owncloud/data/myusername/files)
	 */
	public static $CONFIG_DATADIRECTORY = '';
	/**
	 * the folder that stores the data for the root filesystem (e.g. /srv/http/owncloud/data)
	 */
	public static $CONFIG_DATADIRECTORY_ROOT = '';

	/**
	 * SPL autoload
	 */
	public static function autoload($className){
		if(array_key_exists($className,Atom::$CLASSPATH)){
			require_once Atom::$CLASSPATH[$className];
		}
		elseif(strpos($className,'Atom_')===0){
			require_once strtolower(str_replace('_','/',substr($className,3)) . '.php');
		}
		elseif(strpos($className,'Sabre_')===0) {
			require_once str_replace('_','/',$className) . '.php';
		}
	}

	public static function init(){
		// register autoloader
		spl_autoload_register(array('Atom','autoload'));

		// set some stuff
		//ob_start();
		error_reporting(E_ALL | E_STRICT);
		//if (defined('DEBUG') && DEBUG){
			ini_set('display_errors', 1);
		//}

		date_default_timezone_set('Asia/Shanghai');
		ini_set('arg_separator.output','&amp;');

		//set http auth headers for apache+php-cgi work around
		if (isset($_SERVER['HTTP_AUTHORIZATION']) && preg_match('/Basic\s+(.*)$/i', $_SERVER['HTTP_AUTHORIZATION'], $matches))
		{
			list($name, $password) = explode(':', base64_decode($matches[1]));
			$_SERVER['PHP_AUTH_USER'] = strip_tags($name);
			$_SERVER['PHP_AUTH_PW'] = strip_tags($password);
		}

		//set http auth headers for apache+php-cgi work around if variable gets renamed by apache
		if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) && preg_match('/Basic\s+(.*)$/i', $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $matches))
		{
			list($name, $password) = explode(':', base64_decode($matches[1]));
			$_SERVER['PHP_AUTH_USER'] = strip_tags($name);
			$_SERVER['PHP_AUTH_PW'] = strip_tags($password);
		}

		// calculate the documentroot
		Atom::$DOCUMENTROOT=realpath($_SERVER['DOCUMENT_ROOT']); //echo 'Document root: ' . Atom::$DOCUMENTROOT . '<br />';
		Atom::$SERVERROOT=str_replace("\\",'/',substr(__FILE__,0,-20)); //echo 'Server root: ' . Atom::$SERVERROOT . '<br />';
		Atom::$SUBURI=substr(realpath($_SERVER["SCRIPT_FILENAME"]),strlen(Atom::$SERVERROOT)); //echo 'SUBURI: ' . Atom::$SUBURI . '<br />';
		$scriptName=$_SERVER["SCRIPT_NAME"];
		if(substr($scriptName,-1)=='/'){
			$scriptName.='index.php';
		}
		Atom::$WEBROOT=substr($scriptName,0,strlen($scriptName)-strlen(Atom::$SUBURI));

		if(Atom::$WEBROOT!='' and Atom::$WEBROOT[0]!=='/'){
			Atom::$WEBROOT='/'.Atom::$WEBROOT;
		} //echo '$WEBROOT: ' . Atom::$WEBROOT . '<br />';

		// set the right include path
		set_include_path(Atom::$SERVERROOT.'/lib'.PATH_SEPARATOR.Atom::$SERVERROOT.'/config'.PATH_SEPARATOR.Atom::$SERVERROOT.'/3rdparty'.PATH_SEPARATOR.get_include_path().PATH_SEPARATOR.Atom::$SERVERROOT);

		// redirect to https site if configured
		if( Atom_Config::getValue( "forcessl", false )){
			ini_set("session.cookie_secure", "on");
			if(!isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] != 'on') {
				$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
				header("Location: $url");
				exit();
			}
		}

		ini_set('session.cookie_httponly','1;');
		//session_start();

		// Add the stuff we need always
		Atom_Util::addScript( "jquery-1.6.4.min" );
		Atom_Util::addScript( "jquery-ui-1.8.14.custom.min" );
		Atom_Util::addScript( "jquery-showpassword" );
		Atom_Util::addScript( "jquery.infieldlabel.min" );
		Atom_Util::addScript( "jquery-tipsy" );
		Atom_Util::addScript( "js" );
		//Atom_Util::addScript( "multiselect" );
		Atom_Util::addScript('search','result');
		Atom_Util::addStyle( "styles" );
		Atom_Util::addStyle( "multiselect" );
		Atom_Util::addStyle( "jquery-ui-1.8.14.custom" );
		Atom_Util::addStyle( "jquery-tipsy" );

		$errors=Atom_Util::checkServer();
		if(count($errors)>0) {
			Atom_Template::printGuestPage('', 'error', array('errors' => $errors));
			exit;
		}

		// TODO: we should get rid of this one, too
		// WARNING: to make everything even more confusing,
		//   DATADIRECTORY is a var that changes and DATADIRECTORY_ROOT
		//   stays the same, but is set by "datadirectory".
		//   Any questions?
		Atom::$CONFIG_DATADIRECTORY = Atom_Config::getValue( "datadirectory", Atom::$SERVERROOT."/data" ); //echo 'Atom::$CONFIG_DATADIRECTORY: ' . Atom::$CONFIG_DATADIRECTORY . '<br />';

		// User and Groups
		if( !Atom_Config::getValue( "installed", false )){
			$_SESSION['user_id'] = '';
		}

		Atom_Group::setBackend( Atom_Config::getValue( "groupbackend", "database" ));

		// Was in required file ... put it here
		Atom_Filesystem::registerStorageType('local','Atom_Filestorage_Local',array('datadir'=>'string'));

		// Set up file system unless forbidden
		global $RUNTIME_NOSETUPFS;
		if(!$RUNTIME_NOSETUPFS ){
			Atom_Util::setupFS();
		}

		// Load Apps
		// This includes plugins for users and filesystems as well
		global $RUNTIME_NOAPPS;
		if(!$RUNTIME_NOAPPS ){
			//Atom_App::loadApps();
		}

		// Last part: connect some hooks
		Atom_Hook::connect('Atom_User', 'post_createUser', 'Atom_Connector_Sabre_Principal', 'addPrincipal');
		Atom_Hook::connect('Atom_User', 'post_deleteUser', 'Atom_Connector_Sabre_Principal', 'deletePrincipal');
	}
}

// define runtime variables - unless this already has been done
if( !isset( $RUNTIME_NOSETUPFS )){
	$RUNTIME_NOSETUPFS = false;
}
if( !isset( $RUNTIME_NOAPPS )){
	$RUNTIME_NOAPPS = false;
}

Atom::init();

if(!function_exists('get_temp_dir')) {
	function get_temp_dir() {
		if( $temp=ini_get('upload_tmp_dir') )        return $temp;
		if( $temp=getenv('TMP') )        return $temp;
		if( $temp=getenv('TEMP') )        return $temp;
		if( $temp=getenv('TMPDIR') )    return $temp;
		$temp=tempnam(__FILE__,'');
		if (file_exists($temp)) {
			unlink($temp);
			return dirname($temp);
		}
		return null;
	}
}

require_once('fakedirstream.php');

// FROM search.php
//new Atom_Search_Provider_File();

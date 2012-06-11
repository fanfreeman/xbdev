<?php

// choose database name by domain name, so that each company can have its own database
$strDomain =  $_SERVER['SERVER_NAME'];
$strDomain = preg_replace('#^www\.(.+\.)#i', '$1', $strDomain);
switch ($strDomain) {
	case 'atomnewscorp.com':
		$strDatabaseName = 'atom_newscorp';
		break;
	default:
		$strDatabaseName = 'atom';
	break;
}

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..',
	'name'=>'Atom',
	'theme' => 'classic',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
        'application.models.biz.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'atom',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
	),

	// application components
	'components'=>array(
			
		'clientScript' => array(
			'class' => 'ext.minify.EClientScript',
			'combineScriptFiles' => true, // By default this is set to false, set this to true if you'd like to combine the script files
			'combineCssFiles' => true, // By default this is set to false, set this to true if you'd like to combine the css files
			'optimizeCssFiles' => false,  // @since: 1.1
			'optimizeScriptFiles' => false,   // @since: 1.1
		),
			
		'viewRenderer'=>array(
			'class'=>'application.extensions.ESmartyViewRenderer',
			'fileExtension' => '.html',
			//'pluginsDir' => 'application.smartyPlugins',
			//'configDir' => 'application.smartyConfig',
		),
			
		'user'=>array(
			'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'file'=>'file/index',
				'profile/<uid:\d+>'=>'profile/index',
				'file/getsharingusers/<uid:\d+>'=>'file/getsharingusers',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			'showScriptName'=>false,
		),
		// commented because we are not using sqlite
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=' . $strDatabaseName,
			'emulatePrepare' => true,
			'username' => 'freeman',
			'password' => 'samurai',
			'charset' => 'utf8',
			'tablePrefix' => ''
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		'servertype'	=>	'local',
		'baseurl'		=>	'http://www.' . $strDomain . '/',
	),
);
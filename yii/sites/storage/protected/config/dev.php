<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$pubConfig = require dirname(__FILE__).'/../../../public/protected/config/dev/global.php';

return array(

	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	
	// preloading 'log' component
	'preload'=>array('log'),

	'import'=>array(
		'application.components.*',
	),

	'components'=>array(
		'db'=>$pubConfig['components']['db'],
		
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
);
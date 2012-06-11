<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..',
	'name'=>'Atom Console Application',
	'import'=>array(
    	'application.models.*',
    	'application.models.biz.*',
    	'application.components.*',
    ),
	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=atom',
			'emulatePrepare' => true,
			'username' => 'freeman',
			'password' => 'samurai',
			'charset' => 'utf8',
			'tablePrefix' => ''
		),
	),
);
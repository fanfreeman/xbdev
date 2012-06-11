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
			'connectionString' => 'mysql:host=172.16.243.130;dbname=atom',
			'emulatePrepare' => true,
			'username' => 'atomlive',
			'password' => 'l1v34t0m',
			'charset' => 'utf8',
			'tablePrefix' => ''
		),
	),
);
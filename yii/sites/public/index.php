<?php
// change the following paths if necessary
// bootstrap文件

$yii=dirname(__FILE__).'/../../framework/yii.php';
// 根据环境选择config文件
if (empty($strConfigType)) {
	if (strpos($_SERVER['HTTP_HOST'], 'dev') !== false) {
		$strConfigType = 'dev';
	} else if (strpos($_SERVER['HTTP_HOST'], 'stage') !== false) {
		$strConfigType = 'stage';
	}
}
switch ($strConfigType) {
	case 'local':
		$config=dirname(__FILE__).'/protected/config/local/global.php';
		break;
	case 'dev':
		$config=dirname(__FILE__).'/protected/config/dev/global.php';
		break;
	case 'stage':
		$config=dirname(__FILE__).'/protected/config/stage/global.php';
		break;
	case 'live':
		$config=dirname(__FILE__).'/protected/config/live/global.php';
		break;
	default:
		exit('invalid config type');
}

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();

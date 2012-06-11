<?php
require_once(dirname(__FILE__).'/../paths.php');
// change the following paths if necessary
$yiic=dirname(__FILE__).'/../../../framework/yiic.php';
//$config=dirname(__FILE__).'/config/console.php';
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
		$config=dirname(__FILE__).'/config/local/console.php';
		break;
	case 'dev':
		$config=dirname(__FILE__).'/config/dev/console.php';
		break;
	case 'stage':
		$config=dirname(__FILE__).'/config/stage/console.php';
		break;
	default:
		$config=dirname(__FILE__).'/config/live/console.php';
	break;
}

require_once($yiic);

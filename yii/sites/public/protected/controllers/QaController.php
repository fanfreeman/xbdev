<?php

class QaController extends Controller
{
    public $layout = '//layouts/atom';
	public $mobileDevice = false;

    function init()
    {
        $array_admin = array(2,3,7,10,11);//2韩磊，3徐晨，7鹏飞，10李东，11邓威
		$id_user = Yii::app()->user->id;
		if(in_array($id_user,$array_admin))
		{
		   if(isset($_SERVER['HTTP_USER_AGENT']))
			{
				$clientkeywords = array('nokia','sony','ericsson','mot','samsung',
				'htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel',
				'lenovo','iphone','ipod','blackberry','meizu','android','netfront',
				'symbian','ucweb','windowsce','palm','operamini','operamobi',
				'openwave','nexusone','cldc','midp','wap','mobile');
				
				if (preg_match("/(".implode('|',$clientkeywords).")/i",strtolower($_SERVER['HTTP_USER_AGENT'])))
				{
					$this->mobileDevice = true;
					$this->layout = '/layouts/mobile/atom';
				}
			}
		 }
    }

    function actionIndex()
    {	
		$data = array();
		/*
		$alphabet = 'a';
		for($i = 1;$i<27;$i++,$alphabet++)
		{
			$temp['result'] = bizDirectory::getDirectoryByAlphabet($alphabet);
			$temp['alphabet'] = $alphabet;
			$data[] = $temp;
		}
		*/
		$data = bizDirectory::getAllDirectory(false,false);
		if(!$this->mobileDevice)
		{
			$this->render('index', array('data'=>$data));
		}
		else
		{
			$this->render('/directory/mobile/index', array('data'=>$data));
		}
	}
}
?>
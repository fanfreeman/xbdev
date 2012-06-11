<?php
class SiteController extends Controller
{
	
	public $defaultAction = 'desktop';
	public $layout='//layouts/home';
	public $layoutLogin='/layouts/login';
	public $defaultLogin='/site/login';
	/**
	 * Declares class-based actions.
	 */
	 
	public function init()
    {
		if(isset($_SERVER['HTTP_USER_AGENT']))
		{
			$clientkeywords = array('nokia','sony','ericsson','mot','samsung',
			'htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel',
			'lenovo','iphone','ipod','blackberry','meizu','android','netfront',
			'symbian','ucweb','windowsce','palm','operamini','operamobi',
			'openwave','nexusone','cldc','midp','wap','mobile');
			// 从HTTP_USER_AGENT中查找手机浏览器的关键字
			if (preg_match("/(".implode('|',$clientkeywords).")/i",strtolower($_SERVER['HTTP_USER_AGENT'])))
			{
				$this->layoutLogin = '/layouts/mobile/atom';
				$this->defaultLogin = '/site/loginmobile';
			}
		}
		
    }
	
	public function actions()
	{
		exit;
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		error_reporting(E_ALL | E_STRICT);
		ini_set('display_errors', 1);
        //$this->showMsg('denglu', 'index.php?r=site/login');
	    //var_dump(Yii::app()->user->getIsGuest());
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index', array('data'=>array()));
	}

	/**
	 * 用户信息修改
	 */
	public function actionUpdate()
	{
		if (!empty($_POST)) {
			Users::model()->update($_POST, Yii::app()->user->getId());
			$this->render('update');
			return true;
		} else
			$this->render('update');
	}

	//用户在线测试
	public function actionOnline()
	{
		echo Yii::app()->user->isOnline();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
	    if (Yii::app()->request->isPostRequest) {
	        $rememberme = intval(@$_POST['rememberme']);
	        $duration = $rememberme ? 3600*24*7 : 0; // 7 days
	        $email = trim(@$_POST['email']);
 	        $password  = trim(@$_POST['password']);
	        $identity = new UserIdentity($email, $password);
			if ($identity->authenticate()) {
	           Yii::app()->user->login($identity, $duration);
	            $this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('site/desktop')));
			} else {
			    $this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('site/login', array('message'=>'Invalid e-mail or password.'))));
	        }
	        //echo Yii::app()->user->getId();exit;
	        //var_dump(Yii::app()->user->getIsGuest());exit;
            // show erro message
	        //$this->redirect(Yii::app()->user->getreturnUrl('index.php?r=site/index'));
	    } else {
	    	if(isset($_GET['message'])){
	    		//$message = "你好<font color='green'>" . $_GET['message'] . "</font>注册成功，请登录";
	    		$message = $_GET['message'];
	    	}else{
	    		$message = '';
	    	}
			$this->layout=$this->layoutLogin;
	        $this->render('login',array('message'=>$message));
	    }
	    exit;
	}

	public function actionLoginMobile()
	{
		if (Yii::app()->request->isPostRequest) {
			$this->redirect('ddd');
			/*
	        $rememberme = intval(@$_POST['rememberme']);
	        $duration = $rememberme ? 3600*24*7 : 0; // 7 days
	        $email = trim(@$_POST['email']);
 	        $password  = trim(@$_POST['password']);
	        $identity = new UserIdentity($email, $password);
			if ($identity->authenticate()) {
	           Yii::app()->user->login($identity, $duration);
	            $this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('Site/atom')));
			} else {
			    $this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('Site/login', array('message'=>'Invalid e-mail or password.'))));
	        }
	        //echo Yii::app()->user->getId();exit;
	        //var_dump(Yii::app()->user->getIsGuest());exit;
            // show erro message
	        //$this->redirect(Yii::app()->user->getreturnUrl('index.php?r=site/index'));
	    */
		} else {
			/*
	    	if(isset($_GET['message'])){
	    		//$message = "你好<font color='green'>" . $_GET['message'] . "</font>注册成功，请登录";
	    		$message = $_GET['message'];
	    	}else{
	    		$message = '';
	    	}
			*/
			
			$this->layout=$this->layoutLogin;
			//echo $this->layout;
		    $this->render('/mobile/login');
	    }
	    exit;
	}
	
	public function actionUserIdentity()
	{
		if (Yii::app()->request->isPostRequest)
		{
			$callback['success'] = true;
			//$rememberme = intval(@$_POST['rememberme']);
	        $rememberme = 1;
			$duration = $rememberme ? 3600*24*7 : 0; // 7 days
			$email = trim(@$_POST['email']);
 	        $password  = trim(@$_POST['password']);
	        $identity = new UserIdentity($email, $password);
			if ($identity->authenticate())
			{
	        	Yii::app()->user->login($identity, $duration);
				$callback['authenticate'] = true;
				$callback['url_redirect'] = Yii::app()->createUrl('directory');
			} 
			else 
			{
				$callback['authenticate'] = false;
			    //$this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('Site/login', array('message'=>'Invalid e-mail or password.'))));
	        }
		}
		else
		{
			$callback['success'] = false;
		}
		
		echo json_encode($callback);	
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 *  homepage.
	 */
	public function actionDesktop()
	{
		if(!(Yii::app()->user->id))
		{
			$this->redirect(Yii::app()->createUrl($this->defaultLogin));
		}
		$this->render('desktop');
	}
	/**
	 *  downBrowser.
	 */
	public function actiondownBrowser()
	{
		$this->layout="/layouts/downbrowser";
		$this->render('downBrowser');
	}
}
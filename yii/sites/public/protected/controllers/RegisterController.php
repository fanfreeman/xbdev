<?php

class RegisterController extends Controller
{
    public $layout = '//layouts/login';

    function init()
    {
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jQuery-1.7.min.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jQuery.UI.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/UI.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->Theme->baseUrl.'/js/script.js', CClientScript::POS_HEAD);
    }
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/*
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('Registerauto','Register'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	*/

    function actionIndex()
    {
        if (Yii::app()->request->isPostRequest) {
            $email = trim(@$_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $this->showMsg('email : '.$email.' 格式错误');
            }
            if ($arrayUser = bizUser::getInfo(array('email' => $email))) {
                $this->showMsg('email : '.$email.' 已经被注册');
            }

            $code = Password::encrypt($email);
            $url = Yii::app()->request->hostInfo.$this->createUrl('register/register', array('email'=>$email, 'code'=>$code));
            $this->sendMail($email, '注册邮件', '请点击下面的链接进行注册<br>'.$url);
            $this->showMsg('请通过验证邮件注册');
        }
        $this->render('index', array());
    }
	
	 function actionRegisterauto()
    {
        if (Yii::app()->request->isPostRequest) {
            $email = trim(@$_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
                //$this->showMsg('email : '.$email.' 格式错误');
            }
            if ($arrayUser = bizUser::getInfo(array('email' => $email))) {
                //$this->showMsg('email : '.$email.' 已经被注册');
            }

            $code = Password::encrypt($email);
            $url = Yii::app()->request->hostInfo.$this->createUrl('register/register', array('email'=>$email, 'code'=>$code));
            $this->sendMail($email, '注册邮件', '请点击下面的链接进行注册<br>'.$url);
            //$this->showMsg('请通过验证邮件注册');
        }
		$this->render('registerauto', array());
    }

    function actionRegister()
    {
        $email = trim(@$_GET['email']);
        $code = trim(@$_GET['code']);

        if (!Password::validate($code, $email)) {
            $this->showMsg('email验证失败, 请重新注册', $this->createUrl('register/index'));
        }

        if (Yii::app()->request->isPostRequest) {
            $info = (array)@$_POST['info'];
            if (array_diff(array('firstname', 'lastname', 'password', 'lastname'), array_keys($info))) {
                $this->showMsg('缺少必要参数');
            }
            $info['firstname'] = strip_tags(trim($info['firstname']));
            $info['lastname'] = strip_tags(trim($info['lastname']));
            $info['email'] = $email;
            $info['password'] = trim($info['password']);
            if (empty($info['firstname']) || empty($info['email']) || empty($info['password']) || empty($info['lastname'])) {
                $this->showMsg('缺少必要参数');
            }
            $info['email'] = filter_var($info['email'], FILTER_VALIDATE_EMAIL);

            if (!$info['email']) {
                $this->showMsg('email : '.$info['email'].' 格式错误');
            }

            if ($arrayUser = bizUser::getInfo(array('email' => $info['email']))) {
                $this->showMsg('email : '.$info['email'].' 已经被注册');
            }
            $id = bizUser::register($info);
            if (empty($id)) {
            	$this->showMsg('注册失败', $this->createUrl('/register'));
            } else {
            	//$this->showMsg('注册成功', $this->createUrl('/site/login',array("message" => "您好，<font color='green'>" . $info['firstname'] . "</font>，您已注册成功，请登录。")));
				
			 $identity = new UserIdentity($info['email'] , $info['password']);
			if ($identity->authenticate()) {
				$duration = 3600*24*7 ; // 7 days
	        	Yii::app()->user->login($identity, $duration);
	            $this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('Site/atom')));
				} 
			else 
				{
			    $this->redirect(Yii::app()->user->getreturnUrl(Yii::app()->createUrl('Site/login', array('message'=>'Invalid e-mail or password.'))));
	        	}
            }
        }

        $this->render('register', array('email'=>$email, 'code'=> $code));
    }
}
?>
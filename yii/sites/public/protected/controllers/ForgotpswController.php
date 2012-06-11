<?php

class ForgotpswController extends Controller
{
    public $layout = '//layouts/login';

    function init()
    {
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jQuery-1.7.min.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jQuery.UI.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/UI.js', CClientScript::POS_HEAD);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->Theme->baseUrl.'/js/script.js', CClientScript::POS_HEAD);
    }

    function actionIndex()
    {
        if (Yii::app()->request->isPostRequest) {
            $email = trim(@$_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
                $this->showMsg('email : '.$email.' 格式错误');
            }
            if (!$arrayUser = bizUser::getInfo(array('email' => $email))) {
                $this->showMsg('email : '.$email.' 无法找到');
            }

            $code = Password::encrypt($email);
            $url = Yii::app()->request->hostInfo.$this->createUrl('forgotpsw/retrieve', array('email'=>$email, 'code'=>$code));
            $this->sendMail($email, '密码重设邮件', '请点击下面的链接进行密码重设<br>'.$url);
            $this->showMsg('请通过验证邮件重设密码');
        }
        $this->render('index', array());
    }

	function actionRetrieve()
    {
        $email = trim(@$_GET['email']);
        $code = trim(@$_GET['code']);

        if (!Password::validate($code, $email)) {
            $this->showMsg('email验证失败, 请重新输入', $this->createUrl('forgotpsw/index'));
        }

        if (Yii::app()->request->isPostRequest) {
            $info = (array)@$_POST['info'];
            if (array_diff(array('password'), array_keys($info))) {
                $this->showMsg('请填写新密码！');
            }
            $info['password'] = trim($info['password']);
            if (empty($info['password'])) {
                $this->showMsg('请填写新密码！');
            }
            
            if ($arrayUser = bizUser::getInfo(array('email' => $_GET['email']))) {
            	$objUser = Users::model()->find('email = :email', array(':email' => $_GET['email']));
            	$objUser->password = Password::encrypt($info['password']);
            	$intTime_now = time();
            	$objUser->updated = $intTime_now;
            	
            	if (!$objUser->save()) {
            		$this->showMsg('密码重设失败', $this->createUrl('/'));
            	} else {
            		$this->showMsg('密码重设成功！', $this->createUrl('/site/login'));
            	}
            } else {
            	$this->showMsg('email : '.$info['email'].' 无法找到');
            }
            
            if (empty($id)) {
            	$this->showMsg('注册失败', $this->createUrl('/register'));
            } else {
            	$this->showMsg('注册成功', $this->createUrl('/site/login',array("message" => "您好，<font color='green'>" . $info['firstname'] . "</font>，您已注册成功，请登录。")));
            }
        }

        $this->render('retrieve', array('email'=>$email, 'code'=> $code));
    }
}
?>
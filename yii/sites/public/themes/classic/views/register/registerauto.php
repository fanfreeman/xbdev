<?php
echo 'send mail good<br />';

$array_address = array('lei.han1@myspace.cn','lei.han1@myspace.cn','lei.han1@myspace.cn','lei.han1@myspace.cn');

foreach($array_address as $emailaddress)
{
	 sendRegisterMail($emailaddress);
	sleep(1);
}

function sendRegisterMail($emailaddress)
{
	$email = trim($emailaddress);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email)
	{
		return "$emailaddress error format<br />";
	}
	/*
	if ($arrayUser = bizUser::getInfo(array('email' => $email))) 
	{
		return "$emailaddress exsite<br />";
	}
	*/
	//http://hanlei.atom.com/register/register?email=lei.han1%40myspace.cn&code=sha1%3AgG1XeP%3A52c2b0f1df050eac4353933866791816acd3f155
    $code = Password::encrypt($email.date('Y-m-d H'));
	$email_encode = str_replace('@','%40',$email);
	$url = Yii::app()->request->hostInfo.Yii::app()->createUrl('register/register', array('email'=>$email, 'code'=>$code));
	echo $url."<br />";
	$urltest = "http://www.atombeta.com/register/register?email=".$email."&code=".$code;
	echo $urltest."<br />";
	if (sendMail($email, '注册邮件', '请点击下面的链接进行注册<br>'.$url))
	{
		return "$emailaddress register ok<br />";
	}
		
}

function sendMail($email, $subject, $message)
{
	$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
	$mailer->From = 'admin@atom.com';
	$mailer->AddAddress($email);
	$mailer->FromName = 'atom admin';
	$mailer->CharSet = 'UTF-8';
	$mailer->Subject = $subject;
	$mailer->MsgHTML($message);
	return $mailer->Send();
}
?>

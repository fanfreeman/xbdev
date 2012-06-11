<?php

define('ResFeedType', 1);
define('ResCommentType', 2);

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function sendMail($email, $subject, $message)
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
	
	public function sendMailSMTP($email, $subject, $message)
	{
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->IsSMTP(); 
		$mailer->Host     = 'smtp.exmail.qq.com';                 //SMTP服务器地址
		$mailer->Port     = 25;                                 //SMTP服务器端口 
		$mailer->SMTPAuth = true;                               //SMTP认证
		$mailer->Username = 'lei.han@myspace.cn';                //认证用户名 
		$mailer->Password = '177628177628zera';                    //认证密码  
		$mailer->CharSet = 'UTF-8';
		$mailer->Subject  = $subject;				                //邮件标题
		$mailer->Body     =	 $message;                   //邮件正文 
		$mailer->SetFrom('lei.han@myspace.cn', 'HanLei');          //设置发件人
		$mailer->AddAddress($email);                 //添加收件人
		return $mailer->Send();
	}

    public function showMsg($msg, $url = null)
    {
        if ($url) {
            print <<<EOT
            <script type="text/javascript" charset="utf-8">
            alert('$msg');
            location.href = '$url';
            </script>
EOT;
        } else {
            print <<<EOT
            <script type="text/javascript" charset="utf-8">
            alert('$msg');
            history.go(-1);
            </script>
EOT;
        }
        Yii::app()->end();
    }
}
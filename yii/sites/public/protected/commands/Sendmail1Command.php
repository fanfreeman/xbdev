<?php

class Sendmail1Command extends CConsoleCommand
{
	public function run($args)
	{
		//$array_address = array('lei.han@live.com','lei.han1@myspace.cn','45204640@qq.com','lei.han2myspace.cn','geniusmao@gmail.com');
		$array_address = array(
								"zhaoaj@cbc-capital.com",
								"zhaoaj@cbcos.com",
								"aolx@cbc-capital.com",
								"wuman@cbc-capital.com",
								"wuman@cbcos.com",
								"zhangfb@cbcos.com",
								"chenjh@cbc-capital.com",
								"fuxl@cbc-capital.com",
								"lixf@cbcos.com",
								"xinjb@cbcos.com",
								"zoujs@cbcos.com",
								"dusl@cbcos.com",
								"xiongtb@cbcos.com",
								"lijm@cbcos.com",
								"caihy@cbcos.com",
								"tiancy@cbcos.com",
								"hanqi@cbcos.com",
								"shenkj@cbcos.com",
								"qiaowl@cbcos.com",
								"liuzheng@cbcos.com",
								"shangqing@cbcos.com",
								"taoxp@cbcos.com",
								"shengjun@cbcos.com",
								"wangbb@cbcos.com",
								"mali@cbcos.com",
								"lisw@cbcos.com",
								"duht@cbcos.com",
								"tianxin@cbcos.com",
								"chenshuo@cbcos.com",
								"zhangxq@cbcos.com",
								"liufy@cbcos.com",
								"jinna@cbcos.com",
								"zhanglq@cbcos.com",
								"chenxx@cbc-capital.com",
								"zhangying1@cbcos.com",
								"suzl@cbcos.com",
								"liuxf@cbcos.com",
								"fanlm@cbcos.com",
								"wangjing@cbcos.com",
								"mana@cbcos.com",
								"haojie@cbcos.com",
								"chaopeng@cbcos.com",
								"huangwj@cbcos.com",
								"lihl@cbcos.com",
								"jiangwf@cbcos.com",
								"jingwk@cbcos.com",
								"wangmin@cbcos.com",
								"zhouyl@cbcos.com",
								"xush@cbcos.com",
								"liurui@cbcos.com",
								"sunxue@cbcos.com",
								"yangfang@cbcos.com",
								"zhangfang@cbcos.com",
								"yuhong@cbcos.com",
								"chenxf@cbcos.com",
								"gaoyang@cbcos.com",
								"liqiang@cbcos.com",
								"xuexq@cbcos.com",
								"zoufang@cbcos.com",
								"wujian@cbcos.com",
								"lidh@cbcos.com",
								"zhangjm@cbcos.com",
								"zhangyong@cbcos.com",
								"nimm@cbcos.com",
								"wangyj@cbcos.com",
								"yangjin@cbcos.com",
								"qinbin@china-cloud.com",
								"guhw@china-cloud.com",
								"songtao@china-cloud.com",
								"sunhb@china-cloud.com",
								"duqx@china-cloud.com",
								"tongling@china-cloud.com",
								"liufen@china-cloud.com",
								"sunshuang@china-cloud.com",
								"lijs@china-cloud.com",
								"mengys@china-cloud.com",
								"lils@china-cloud.com",
								"lvguang@china-cloud.com",
								"fsong@chinaskycloud.com",
								"yangli@chinaskycloud.com",
								"truman@chinaskycloud.com",
								"zhangfb@chinaskycloud.com",
								"wangchao@chinaskycloud.com",
								"wangqi@chinaskycloud.com",
								"qinjie@cbc-capital.com",
								"qinjie@chinaskycloud.com",
								"tenglq@chinaskycloud.com",
								"wusj@chinaskycloud.com",
								"wuman@chinaskycloud.com",
								"shenyh@chinaskycloud.com",
								"zhangyang@chinaskycloud.com",
								"zongshan@chinaskycloud.com",
								"huxf@chinaskycloud.com",
								"guying@chinaskycloud.com",
								"liull@chinaskycloud.com",
								"houyi@chinaskycloud.com",
								"huolj@chinaskycloud.com",
								"zhangnan@chinaskycloud.com",
								"jiyue@chinaskycloud.com",
								"anna@chinaskycloud.com",
								"yuxw@chinaskycloud.com",
								"tianyx@chinaskycloud.com",
								"liuhuan@chinaskycloud.com",
								"chenpf@chinaskycloud.com",
								"xiyf@chinaskycloud.com",
								"guozy@chinaskycloud.com",
								"wangwei@chinaskycloud.com",
								"wuhm@chinaskycloud.com",
								"nickadams@chinaskycloud.com",
								"huazj@chinaskycloud.com",
								"yewg@chinaskycloud.com",
								"guoxun@chinaskycloud.com",
								"zhangqi@chinaskycloud.com",
								"yangchao@chinaskycloud.com",
								"zhaoyj@chinaskycloud.com",
								"xingjw@chinaskycloud.com",
								"tankh@chinaskycloud.com",
								"zhangyi@chinaskycloud.com",
								"majun@chinaskycloud.com",
								"liucl@chinaskycloud.com",
								"fengyk@chinaskycloud.com",
								"lvyg@chinaskycloud.com",
								"wangzheng@chinaskycloud.com",
								"shixq@chinaskycloud.com",
								"wangcf@chinaskycloud.com",
								"hefk@chinaskycloud.com",
								"wangjian@chinaskycloud.com",
								"jiaoyz@chinaskycloud.com",
								"liujj@chinaskycloud.com",
								"zhangshuang@chinaskycloud.com",
								"dufc@chinaskycloud.com",
								"xinggs@chinaskycloud.com",
								"gankb@chinaskycloud.com",
								"chenqiang@chinaskycloud.com",
								"limj@chinaskycloud.com",
								"wanghd@chinaskycloud.com",
								"qims@chinaskycloud.com",
								"duanxg@chinaskycloud.com",
								"liujn@chinaskycloud.com",
								"zhanghz@chinaskycloud.com",
								"chengying@chinaskycloud.com",
								"wusy@chinaskycloud.com",
								"tangxu@chinaskycloud.com",
								"houyl@chinaskycloud.com",
								"zhaodd@chinaskycloud.com",
								"tiantian@chinaskycloud.com",
								"lina@chinaskycloud.com",
								"xuedq@chinaskycloud.com",
								"yuting@chinaskycloud.com",
								"yangjun@chinaskycloud.com",
								"xuyue@chinaskycloud.com",
								"wangkf@chinaskycloud.com",
								"liubo@chinaskycloud.com",
								"guohong@chinaskycloud.com",
								"hugs@chinaskycloud.com",
								"gaoshan@chinaskycloud.com",
								"linzc@chinaskycloud.com",
								"liwei@chinaskycloud.com",
								"zhangpei@chinaskycloud.com",
								"luwei@chinaskycloud.com",
								"tianyu@chinaskycloud.com",
								"hezs@chinaskycloud.com",
								"mahy@chinaskycloud.com",
								"zouzk@chinaskycloud.com",
								"zhangmh@chinaskycloud.com",
								"loujia@chinaskycloud.com",
								"nanding@chinaskycloud.com",
								"wangbin@chinaskycloud.com",
								"yuanyf@chinaskycloud.com",
								"chinan@chinaskycloud.com",
								"liuqiang@chinaskycloud.com",
								"guodz@chinaskycloud.com",
								"wangyg@chinaskycloud.com",
								"xuzx@chinaskycloud.com",
								"qixy@chinaskycloud.com",
								"liulz@chinaskycloud.com",
								"liuyh@chinaskycloud.com",
								"wangdc@chinaskycloud.com",
								"lilj@chinaskycloud.com",
								"dongsy@chinaskycloud.com",
								"huyg@chinaskycloud.com",
								"luxz@chinaskycloud.com",
								"lizhe@chinaskycloud.com",
								"zhujing@chinaskycloud.com",
								"yangby@chinaskycloud.com",
								"zhanghq@chinaskycloud.com",
								"shigl@chinaskycloud.com",
								"qiuyu@chinaskycloud.com",
								"wuxw@chinaskycloud.com",
								"shiwy@chinaskycloud.com",
								"yangyi@chinaskycloud.com",
								"yangsh@chinaskycloud.com",
								"yangyu@chinaskycloud.com",
								"shenxc@chinaskycloud.com",
								"suncy@chinaskycloud.com",
								"xinliang@chinaskycloud.com",
								"zhaixh@chinaskycloud.com",
								"liuyang@chinaskycloud.com",
								"wenyang@chinaskycloud.com",
								"duanran@chinaskycloud.com",
								"yangfan@chinaskycloud.com",
								"xiaojq@chinaskycloud.com",
								"meixz@chinaskycloud.com",
								"maxiang@chinaskycloud.com",
								"fanwx@chinaskycloud.com",
								"buxl@chinaskycloud.com",
								"fengqian@chinaskycloud.com",
								"wangjie@chinaskycloud.com",
								"gaojian@chinaskycloud.com",
								"huzn@chinaskycloud.com",
								"wangwz@chinaskycloud.com",
								"lijy1@chinaskycloud.com",
								"fangzy@chinaskycloud.com",
								"xuyong@chinaskycloud.com",
								"changzb@chinaskycloud.com",
								"luoxf@chinaskycloud.com",
								"dongjk@chinaskycloud.com",
								"weiwei1@chinaskycloud.com",
								"qiaohu@chinaskycloud.com",
								"songchao@chinaskycloud.com",
								"majun1@chinaskycloud.com",
								"panyp@chinaskycloud.com",
								"zhanglei@chinaskycloud.com",
								"wangxw@chinaskycloud.com",
								"tianpeng@chinaskycloud.com",
								"husy@chinaskycloud.com",
								"longqy@chinaskycloud.com",
								"qiaolei@chinaskycloud.com",
								"fangzj@chinaskycloud.com",
								"jinxf@chinaskycloud.com",
								"songyi@chinaskycloud.com",
								"yumh@chinaskycloud.com",
								"xiewei@chinaskycloud.com",
								"dongyu@chinaskycloud.com",
								"yangbl@chinaskycloud.com",
								"zoubw@chinaskycloud.com",
								"fushuang@chinaskycloud.com",
								"limeng@chinaskycloud.com",
								"zhangzt@chinaskycloud.com",
								"gaoqy@chinaskycloud.com",
								"ninghs@chinaskycloud.com",
								"dujh@chinaskycloud.com",
								"wanghh@chinaskycloud.com",
								"niuxm@chinaskycloud.com",
								"weihong@chinaskycloud.com",
								"liuyj@chinaskycloud.com",
								"zhangbin@chinaskycloud.com",
								"yupeng@chinaskycloud.com",
								"hufeng@chinaskycloud.com",
								"anwei@chinaskycloud.com",
								"lijun@chinaskycloud.com",
								"lishuo@chinaskycloud.com",
								"xiexl@chinaskycloud.com",
								"yushuang@chinaskycloud.com",
								"chensu@chinaskycloud.com",
								"baily@chinaskycloud.com",
								"linyu@chinaskycloud.com",
								"xuehy@chinaskycloud.com",
								"xuxin@chinaskycloud.com",
								"menzr@chinaskycloud.com",
								"xiayy@chinaskycloud.com",
								"sunhs@chinaskycloud.com",
								"zhuzh@chinaskycloud.com",
								"luzs@chinaskycloud.com",
								"zhaojun@chinaskycloud.com",
								"zhangbin1@chinaskycloud.com",
								"xifz@chinaskycloud.com",
								"zhouyang@chinaskycloud.com",
								"lilq@chinaskycloud.com",
								"liuyd@chinaskycloud.com",
								"yangbo@chinaskycloud.com",
								"guanfeng@chinaskycloud.com",
								"tanrf@chinaskycloud.com",
								"husf@chinaskycloud.com",
								"zhouxing@chinaskycloud.com",
								"bipeng@chinaskycloud.com",
								"zhoufeng@chinaskycloud.com",
								"zhuzl@chinaskycloud.com",
								"husc@chinaskycloud.com",
								"lisf@chinaskycloud.com",
								"xubin@chinaskycloud.com",
								"hehk@chinaskycloud.com",
								"songwx@chinaskycloud.com",
								"linsen@chinaskycloud.com",
								"stephenlai@cloudvalley.com.hk",
								"kwchan@hkskycloud.com",
								"charlesmok@cloudvalley.com.hk",
								"tomwei@chinasupercloud.com",
								"guozq@chinasupercloud.com",
								"dongxin@chinasupercloud.com",
								"chenjx@chinasupercloud.com",
								"lihl@chinasupercloud.com"
		);
		echo "send mail good \n";
		$this->sendmail($array_address);
	}
	
	function sendmail($array_address)
	{
		foreach($array_address as $emailaddress)
		{
			echo $this->sendRegisterMail($emailaddress);
			sleep(1);
		}
	}
	
	function chechArray($array_address)
	{
		$arrayUnique = array();
		foreach($array_address as $email)
		{
			if(!in_array($email,$arrayUnique))
			{
				array_push($arrayUnique,$email);
				echo "\"".$email."\",\n";
			}
			else
			{
				//echo  $test." not good \n";
			}
		}
	}
	
	public function sendRegisterMail($emailaddress)
	{
		$email = trim($emailaddress);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if (!$email)
		{
			return "$emailaddress error format\n";
		}
		
		if ($arrayUser = bizUser::getInfo(array('email' => $email))) 
		{
			return "$emailaddress exsite\n";
		}
		
		$code = Password::encrypt($email);
		$email_encode = str_replace('@','%40',$email);
		//$url = 'http://www.atombeta.com/'.Yii::app()->createUrl('register/register', array('email'=>$email, 'code'=>$code));
		$url = "http://www.atombeta.com/register/register?email=".$email_encode."&code=".$code;
		//if (1)
		if ($this->sendMailSMTP($email, '云基地通讯录',"您好，\n\n 昨天云基地通讯录正式上线，因测试过程当中出现一些技术问题，给您注册带来不便请谅解。 我们已经将问题解决，现在请您点击下面的链接注册，完善个人信息:  <a href='".$url."' >云基地通讯录注册链接</a>。\n\n在使用过程中，请给予宝贵意见，谢谢！\n\n 鹏飞"));
		{
			return "$emailaddress register mail send ok\n";
		}
			
	}
	
	 function sendMailSMTP($email, $subject, $message)
	{
		//您好， 我是陈鹏飞。为了能让云基地各公司的同事增进交流，互相学习，我们今天推出一款云基地内部使用的在线通讯录。大家可以点击下面的邀请链接，填写个人资料和联系方式。 谢谢！陈鹏飞
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->IsSMTP(); 
		$mailer->Host     = 'smtp.exmail.qq.com';                 //SMTP服务器地址
		$mailer->Port     = 25;                                 //SMTP服务器端口 
		$mailer->SMTPAuth = true;                               //SMTP认证
		$mailer->Username = 'atom_1@myspace.cn';                //认证用户名 
		$mailer->Password = 'panda888';                    //认证密码  
		$mailer->CharSet = 'UTF-8';
		$mailer->Subject  = $subject;				                //邮件标题
		$mailer->Body     =	 $message;                   //邮件正文 
		$mailer->SetFrom('atom_1@myspace.cn', 'Chen, Pengfei');          //设置发件人
		$mailer->AddAddress($email);                 //添加收件人
		return $mailer->Send();
	}
}

?>
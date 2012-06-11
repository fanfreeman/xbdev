<?php

class Sendmail3Command extends CConsoleCommand
{
	public function run($args)
	{
		//$array_address = array('lei.han@live.com','lei.han1@myspace.cn','45204640@qq.com','lei.han2myspace.cn','geniusmao@gmail.com');
		$array_address = array(
								"ma.yunchao@yoyosys.com",
								"wang.peng@yoyosys.com",
								"liu.yangdong@yoyosys.com",
								"sun.libo@yoyosys.com",
								"zhao.gang@yoyosys.com",
								"ju.tianyang@yoyosys.com",
								"huang.yongjie@yoyosys.com",
								"dong.ruijie@yoyosys.com",
								"he.xiaoliang@yoyosy.com",
								"yin.shaobing@yoyosy.com",
								"wang.jianxing@yoyosys.com",
								"yao.jian@yoyosys.com",
								"xie.zhi@yoyosys.com",
								"bai.zhenlong@yoyosys.com",
								"luan.tian@yoyosys.com",
								"yue.zhiqiang@yoyosys.com",
								"zhang.xinglong@yoyosys.com",
								"li.wei@yoyosys.com",
								"niu.lina@yoyosys.com",
								"hu.guang@yoyosys.com",
								"wang.xi@yoyosys.com",
								"qin.qihua@yoyosys.com",
								"hu.yi@yoyosys.com",
								"wang.bo1@yoyosys.com",
								"tong.gang@yoyosys.com",
								"li.xiao@yoyosys.com",
								"xie.zonghua@yoyosys.com",
								"liang.fukun@yoyosys.com",
								"wang.jiyun@yoyosys.com",
								"zhang.hongbo@yoyosys.com",
								"chen.liquan@yoyosys.com",
								"gao.xiaofan@yoyosys.com",
								"wang.di@yoyosys.com",
								"qin.xue@yoyosys.com",
								"sun.guanyi@yoyosys.com",
								"qi.hui@yoyosys.com",
								"xu.wenquan@yoyosys.com",
								"wen.xin@yoyosys.com",
								"tang.jun@yoyosys.com",
								"zhang.feng@yoyosys.com",
								"wang.bo@yoyosys.com",
								"shan.xi@yoyosys.com",
								"jiang.ning@yoyosys.com",
								"yang.jing@yoyosys.com",
								"pan.liyan@yoyosys.com",
								"sun.xiaomin@yoyosys.com",
								"yao.yong@yoyosys.com",
								"wang.shuyan@yoyosys.com",
								"yang.chunping@yoyosys.com",
								"wu.zhao@yoyosys.com",
								"li.peng@yoyosys.com",
								"huo.hongye@yoyosys.com",
								"zhang.shuai@yoyosys.com",
								"zou.zhilong@yoyosys.com",
								"chen.zhiwei@yoyosys.com",
								"qiu.wenxian@yoyosys.com",
								"jian.liyuan@yoyosys.com",
								"liu.meiqiong@yoyosys.com",
								"wuqiang@ti-net.com.cn",
								"liuyj@ti-net.com.cn",
								"limr@ti-net.com.cn",
								"wangqq@ti-net.com.cn",
								"yujie@ti-net.com.cn",
								"guojia@ti-net.com.cn",
								"lixin@ti-net.com.cn",
								"zhouzh@ti-net.com.cn",
								"panwei@ti-net.com.cn",
								"tangyf@ti-net.com.cn",
								"liukai@ti-net.com.cn",
								"liugj@ti-net.com.cn",
								"liujing@ti-net.com.cn",
								"liuzj@ti-net.com.cn",
								"shenyt@ti-net.com.cn",
								"wangsi@ti-net.com.cn",
								"libai@ti-net.com.cn",
								"liuhy@ti-net.com.cn",
								"zhangxf@ti-net.com.cn",
								"wangjuan@ti-net.com.cn",
								"tangmin@ti-net.com.cn",
								"lujuan@ti-net.com.cn",
								"hehh@ti-net.com.cn",
								"zhangping@ti-net.com.cn",
								"zhaojing@ti-net.com.cn",
								"lill@ti-net.com.cn",
								"chenhui@ti-net.com.cn",
								"baiyang@ti-net.com.cn",
								"qiaoli@ti-net.com.cn",
								"zhaocy@ti-net.com.cn",
								"jingyz@ti-net.com.cn",
								"wangrx@ti-net.com.cn",
								"dongrq@ti-net.com.cn",
								"fuzan@ti-net.com.cn",
								"huanglj@ti-net.com.cn",
								"liqin@ti-net.com.cn",
								"wangjie@ti-net.com.cn",
								"lijin@ti-net.com.cn",
								"wangxl@ti-net.com.cn",
								"liyy@ti-net.com.cn",
								"haogang@ti-net.com.cn",
								"wanglei@ti-net.com.cn",
								"wanglin@ti-net.com.cn",
								"xiecc@ti-net.com.cn",
								"qill@ti-net.com.cn",
								"zhusc@ti-net.com.cn",
								"chenlei@ti-net.com.cn",
								"tanjian@ti-net.com.cn",
								"lisi@ti-net.com.cn",
								"zhenghui@ti-net.com.cn",
								"wangchao@ti-net.com.cn",
								"liuzh@ti-net.com.cn",
								"wangjing@ti-net.com.cn",
								"cuixl@ti-net.com.cn",
								"qincl@ti-net.com.cn",
								"yangyz@ti-net.com.cn",
								"liuzhan@ti-net.com.cn",
								"anjb@ti-net.com.cn",
								"gongcx@ti-net.com.cn",
								"louxue@ti-net.com.cn",
								"wucx@ti-net.com.cn",
								"fengwei@ti-net.com.cn",
								"wang_yl@ti-net.com.cn",
								"niumm@ti-net.com.cn",
								"dongwei@ti-net.com.cn",
								"zhangjh@ti-net.com.cn",
								"lijian@ti-net.com.cn",
								"luoyao@ti-net.com.cn",
								"liucl@ti-net.com.cn",
								"wanghl@ti-net.com.cn",
								"Zhouzh301@ti-net.com.cn",
								"gaoyu@ti-net.com.cn",
								"wangqk@ti-net.com.cn",
								"zhangxy@ti-net.com.cn",
								"shaoying@ti-net.com.cn",
								"ligc@ti-net.com.cn",
								"liujq@ti-net.com.cn",
								"wangjf@ti-net.com.cn",
								"leiwei@ti-net.com.cn",
								"lijl@ti-net.com.cn",
								"huangfeng@ti-net.com.cn",
								"yanxh@ti-net.com.cn",
								"wngjun@ti-net.com.cn",
								"douyl@ti-net.com.cn",
								"yinlei@ti-net.com.cn",
								"caorp@ti-net.com.cn",
								"huangyin@ti-net.com.cn",
								"caopeng@ti-net.com.cn",
								"shiky@ti-net.com.cn",
								"cy@iwaysglobal.com",
								"forest@iwaysglobal.com",
								"wayne@iwaysglobal.com",
								"ray@iwaysglobal.com",
								"jack@iwaysglobal.com",
								"daniel@iwaysglobal.com",
								"thomas@iwaysglobal.com",
								"shelley@iwaysglobal.com",
								"liyan@iwaysglobal.com",
								"zhouchaoyu@iwaysglobal.com",
								"aidong.you@intutochina.com",
								"zhanghua008888@sina.com",
								"wangjia@iwaysglobal.com",
								"zhaoweiwei@iwaysglobal.com",
								"hexuerui@iwaysglobal.com",
								"xiesai@iwaysglobal.com",
								"baifengjiao@iwaysglobal.com",
								"wangdoudou@iwaysglobal.com",
								"wangrui@iwaysglobal.com",
								"yangshuo@gikoo.cn",
								"zhangshuo@gikoo.cn",
								"zhaokun@gikoo.cn",
								"gaoqiuyan@gikoo.cn",
								"hanwenbo@gikoo.cn",
								"wangqiang@gikoo.cn",
								"richard.fung@cbccom.net",
								"kevin.liu@cbccom.net",
								"jie.mei@cbccom.net",
								"lily.li@cbccom.net",
								"yuet.chun@cbccom.net",
								"chen.zong@cbccom.net",
								"xiaonan.liu@cbccom.net",
								"cecelia.ye@cbccom.net",
								"renmj@cernet.com",
								"bin.yu@cbccom.net",
								"tongjun.ding@cbccom.net",
								"suozhong.hui@cbccom.net",
								"honglin.yan@cbccom.net",
								"shuang.guo@cbccom.net",
								"danne.zhao@cbccom.net",
								"michelle.xu@cbccom.net",
								"michelle.wang@cbccom.net",
								"sherry.lu@cbccom.net",
								"sining.hou@cbccom.net",
								"dengming.jia@cbccom.net",
								"candy.luo@cbccom.net",
								"maple.wen@cbccom.net",
								"hailei.yang@cbccom.net",
								"hadara.hong@cbccom.net",
								"ada.wang@cbccom.net",
								"cindy.liu@cbccom.net",
								"albert.luo@cbccom.net",
								"david.jin@cbccom.net",
								"zero.ning@cbccom.net",
								"huawen.mei@cbccom.net",
								"rebecca.yang@cbccom.net",
								"katherine.lin@cbccom.net",
								"ella.wei@cbccom.net",
								"haichao.qiao@cbccom.net",
								"haiyan.gao@cbccom.net",
								"jamesjiang@cloud-times.com",
								"halleyhan@cloud-times.com",
								"tanyong@cloud-times.com",
								"ruandong@cloud-times.com",
								"luojun@cloud-times.com",
								"suli@cloud-times.com",
								"fanyj@cloud-times.com",
								"linjie@cloud-times.com",
								"liusj@cloud-times.com",
								"nannan@cloud-times.com",
								"yangbo1@cloud-times.com",
								"wangjz@cloud-times.com",
								"zhangwh@cloud-times.com",
								"zhubw@cloud-times.com",
								"zhucl@cloud-times.com",
								"wangliang@cloud-times.com",
								"huzg@cloud-times.com",
								"lizw@cloud-times.com",
								"lijs1@cloud-times.com",
								"wangli@cloud-times.com",
								"huangdr@cloud-times.com",
								"xumh@cloud-times.com",
								"wangyq@cloud-times.com",
								"jiajf@cloud-times.com",
								"lidi@cloud-times.com",
								"wangss@cloud-times.com",
								"zhoujz@cloud-times.com",
								"limb@cloud-times.com",
								"lifei@cloud-times.com",
								"daixj@cloud-times.com",
								"jinhy@cloud-times.com",
								"qiulei@cloud-times.com",
								"yeth@cloud-times.com",
								"guofeng@cloud-times.com",
								"sunyan@cloud-times.com",
								"sundj@cloud-times.com",
								"liuww@cloud-times.com",
								"zerozhang@cloud-times.com",
								"yuzb@cloud-times.com",
								"hujuan@cloud-times.com",
								"liutao@cloud-times.com",
								"jiangjian@cloud-times.com",
								"cuihm@cloud-times.com",
								"shids@cloud-times.com",
								"liujie@cloud-times.com",
								"xuhl@cloud-times.com",
								"wangfei@cloud-times.com",
								"zhangfan@cloud-times.com",
								"lijy@cloud-times.com",
								"chenyuan@cloud-times.com",
								"qinchuan@cloud-times.com",
								"longzj@cloud-times.com",
								"wangjianfei@cloud-times.com",
								"wangjing3@cloud-times.com",
								"wangxm@cloud-times.com",
								"mikehuang@cloud-times.com",
								"huangcy@cloud-times.com",
								"zhaoxm@cloud-times.com",
								"liusg@cloud-times.com",
								"shijun@cloudvsp.com",
								"majun@cloudvsp.com",
								"liuqingliu@cloudvsp.com",
								"wangxiaohui@cloudvsp.com",
								"liuyu@cloudvsp.com",
								"hudongmei@cloudvsp.com",
								"jiaxiaofeng@cloudvsp.com",
								"weiyiran@cloudvsp.com",
								"wangbin@cloudvsp.com",
								"lihuakun@cloudvsp.com",
								"huhailin@cloudvsp.com",
								"zhenghongmao@cloudvsp.com",
								"maoguoni@cloudvsp.com",
								"sunlei@cloudvsp.com",
								"caiseng@cloudvsp.com",
								"wunan@cloudvsp.com",
								"zhangling@cloudvsp.com",
								"zhouyuyong@cloudvsp.com",
								"pchen@myspace.cn",
								"yshen@myspace.cn",
								"chuang@myspace.cn",
								"freeman@myspace.cn",
								"lei.han@myspace.cn",
								"chen.xu@myspace.cn",
								"xqiao@myspace.cn"
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
		$mailer->Username = 'atom_3@myspace.cn';                //认证用户名 
		$mailer->Password = 'panda888';                    //认证密码  
		$mailer->CharSet = 'UTF-8';
		$mailer->Subject  = $subject;				                //邮件标题
		$mailer->Body     =	 $message;                   //邮件正文 
		$mailer->SetFrom('atom_3@myspace.cn', 'Chen, Pengfei');          //设置发件人
		$mailer->AddAddress($email);                 //添加收件人
		return $mailer->Send();
	}
}

?>
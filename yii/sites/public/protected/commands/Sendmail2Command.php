<?php

class Sendmail2Command extends CConsoleCommand
{
	public function run($args)
	{
		//$array_address = array('lei.han@live.com','lei.han1@myspace.cn','45204640@qq.com','lei.han2myspace.cn','geniusmao@gmail.com');
		$array_address = array(
								"xuebin@chinasupercloud.com",
								"wangqing@chinasupercloud.com",
								"zhangyong@chinasupercloud.com",
								"wangxf@chinasupercloud.com",
								"liuzh@chinasupercloud.com",
								"niuyn@chinasupercloud.com",
								"zhangxl@chinasupercloud.com",
								"liuxu@chinasupercloud.com",
								"fangdx@chinasupercloud.com",
								"yinfei@chinasupercloud.com",
								"licx@chinasupercloud.com",
								"fuli@chinaskycloud.com",
								"kingtsui@chinasupercloud.com",
								"yangyong@chinasupercloud.com",
								"wangjm@chinasupercloud.com",
								"pro@chinasupercloud.com",
								"whd@chinasupercloud.com",
								"wangjing1@chinasupercloud.com",
								"lijy@chinasupercloud.com",
								"kanglei@chinasupercloud.com",
								"zhongxie@chinasupercloud.com",
								"wangxc@chinasupercloud.com",
								"qad@chinasupercloud.com",
								"houxb@chinasupercloud.com",
								"suyf@chinasupercloud.com",
								"lijuan@chinasupercloud.com",
								"liuzt@chinasupercloud.com",
								"weiyy@chinasupercloud.com",
								"wench@chinasupercloud.com",
								"jiaojc@chinasupercloud.com",
								"maho@chinasupercloud.com",
								"tianjj@chinasupercloud.com",
								"hanjin@chinasupercloud.com",
								"yangfan1@chinasupercloud.com",
								"zhouff@chinasupercloud.com",
								"gengzy@chinasupercloud.com",
								"xuxq@chinasupercloud.com",
								"hujj@chinasupercloud.com",
								"zhangcheng@chinasupercloud.com",
								"yuct@chinasupercloud.com",
								"maggie_sun@chinasupercloud.com",
								"caohe@chinasupercloud.com",
								"wurui@chinasupercloud.com",
								"xiys@chinasupercloud.com",
								"liangyz@chinasupercloud.com",
								"qumc@chinasupercloud.com",
								"liwh@chinasupercloud.com",
								"yangyan@chinasupercloud.com",
								"liujia@chinasupercloud.com",
								"anqi@chinasupercloud.com",
								"lizw@chinasupercloud.com",
								"sunkai@chinasupercloud.com",
								"linzhe@chinasupercloud.com",
								"zhouxiang@chinasupercloud.com",
								"wangning@chinasupercloud.com",
								"liyj@chinasupercloud.com",
								"liusong@chinasupercloud.com",
								"zhangxm@chinasupercloud.com",
								"sunfy@chinasupercloud.com",
								"fuli@chinasupercloud.com",
								"shengmin@chinasupercloud.com",
								"xiaotian@chinasupercloud.com",
								"zhaojt@chinasupercloud.com",
								"jiachao@chinasupercloud.com",
								"baiyt@chinasupercloud.com",
								"mifs@chinasupercloud.com",
								"lianzw@chinasupercloud.com",
								"liujb@chinasupercloud.com",
								"jiaxl@chinasupercloud.com",
								"mawei@chinasupercloud.com",
								"gaoxu@chinasupercloud.com",
								"weiyuan@chinasupercloud.com",
								"yangbg@chinasupercloud.com",
								"liurong@chinasupercloud.com",
								"yangyx@chinasupercloud.com",
								"wangwt@chinasupercloud.com",
								"libin@chinasupercloud.com",
								"wangdd@chinasupercloud.com",
								"tianchun@chinasupercloud.com",
								"shenlong@chinasupercloud.com",
								"guohn@chinasupercloud.com",
								"qiansj@chinasupercloud.com",
								"zhouwei@chinasupercloud.com",
								"liangchun@chinasupercloud.com",
								"wentt@chinasupercloud.com",
								"liqiang@chinasupercloud.com",
								"qurui@chinasupercloud.com",
								"zouys@chinasupercloud.com",
								"cuilj@cbcos.com",
								"chenyf@chinasupercloud.com",
								"liusc@chinasupercloud.com",
								"fujm@chinasupercloud.com",
								"chenchen@chinasupercloud.com",
								"guanrui@chinasupercloud.com",
								"huangyj@chinasupercloud.com",
								"zhaojw@chinasupercloud.com",
								"jiangwf@chinasupercloud.com",
								"oscar_chang@tcloudcomputing.com",
								"hanzhao_gao@tcloudcomputing.com",
								"peter_zhang@tcloudcomputing.com",
								"dapeng_gao@tcloudcomputing.com",
								"hongtu_zang@tcloudcomputing.com",
								"yuchao_liu@tcloudcomputing.com",
								"amanda_lun@tcloudcomputing.com",
								"yanhui_xu@tcloudcomputing.com",
								"xue_li@tcloudcomputing.com",
								"yi_qiu@tcloudcomputing.com",
								"huapeng_li@tcloudcomputing.com",
								"longguang_yue@tcloudcomputing.com",
								"david_dong@tcloudcomputing.com",
								"owen_wang@tcloudcomputing.com",
								"shiguo_meng@tcloudcomputing.com",
								"huawei_jiang@tcloudcomputing.com",
								"yang_guo@tcloudcomputing.com",
								"justin_jiang@tcloudcomputing.com",
								"liyuan_you@tcloudcomputing.com",
								"xinghui_qian@tcloudcomputing.com",
								"zhiqun_guo@tcloudcomputing.com",
								"hetao_li@tcloudcomputing.com",
								"mice_xia@tcloudcomputing.com",
								"yaoxiang_han@tcloudcomputing.com",
								"jiaxin_cao@tcloudcomputing.com",
								"gavin_lee@tcloudcomputing.com",
								"fred_liu@tcloudcomputing.com",
								"zhennan_sun@tcloudcomputing.com",
								"kaufman_chang@tcloudcomputing.com",
								"joe_lee@tcloudcomputing.com",
								"ningqi@cncbb.com",
								"wuman@cncbb.com",
								"hewd@cncbb.com",
								"gaoyh@cncbb.cm",
								"wangzhao@cncbb.com",
								"qiyue@cncbb.com",
								"gongxue@cncbb.com",
								"wangran@cncbb.com",
								"chengbo@cncbb.com",
								"yusm@cncbb.com",
								"tangli@cncbb.com",
								"zhengjian@cncbb.com",
								"yangjg@cncbb.com",
								"tanxy@cncbb.com",
								"zhangjm@cncbb.com",
								"weiming@cncbb.com",
								"laijt@cncbb.com",
								"caoyc@cncbb.com",
								"xuzb@cncbb.com",
								"zhoushu@cncbb.com",
								"wangning@cncbb.com",
								"shalei@cncbb.com",
								"dongyn@cncbb.com",
								"yuanxf@cncbb.com",
								"yangyi@cncbb.com",
								"zhangxiang@cncbb.com",
								"gujj@cncbb.com",
								"hanxiong@cncbb.com",
								"zhouxy@cncbb.com",
								"leyan@cncbb.com",
								"lixj@cncbb.com",
								"guoyl@cncbb.com",
								"shijian@cncbb.com",
								"chenmin@cncbb.com",
								"wangst@cncbb.com",
								"cuijing@cncbb.com",
								"lubo@cncbb.com",
								"huangsheng@cncbb.com",
								"xiaobo@cncbb.com",
								"liyang@cncbb.com",
								"panglei@cncbb.com",
								"aichuan@cncbb.com",
								"fuhao@cncbb.com",
								"gaoxx@cncbb.com",
								"zhangjl@cncbb.com",
								"shitao@cncbb.com",
								"wuting@cncbb.com",
								"wangxt@cncbb.com",
								"yuyh@cncbb.com",
								"zoudw@cncbb.com",
								"linyan@cloud-cube.net",
								"xuhz@cloud-frame.com",
								"fuquan@cloud-frame.com",
								"zhaowl@cloud-frame.com",
								"yangxt@cloud-frame.com",
								"heyi@cloud-frame.com",
								"cuihb@cloud-frame.com",
								"zhoufeng@cloud-frame.com",
								"lixin@cloud-frame.com",
								"lijy@cloud-frame.com",
								"zhangbing@cloud-frame.com",
								"kongtao@cloud-frame.com",
								"huangxh@cloud-frame.com",
								"wangchuan@cloud-frame.com",
								"sunzy@cloud-frame.com",
								"linsf@cloud-frame.com",
								"niuzg@cloud-frame.com",
								"wangxh@cloud-frame.com",
								"suxw@cloud-frame.com",
								"wangxh1@cloud-frame.com",
								"wanggl@cloud-frame.com",
								"malu@cloud-frame.com",
								"huxw@cloud-frame.com",
								"zhengwei@cloud-frame.com",
								"luym@cloud-frame.com",
								"wufen@cloud-frame.com",
								"fengxin@cloud-frame.com",
								"wangfei@cloud-frame.com",
								"yandong@cbcos.com",
								"zhouliang@cloud-frame.com",
								"yangWl@cloud-frame.com",
								"mayl@cloud-frame.com",
								"chenshuang@cloud-frame.com",
								"zhangqing@cloud-frame.com",
								"zhouyy@cloud-frame.com",
								"dingwen@cloud-frame.com",
								"lianyuan@cloud-frame.com",
								"chenzg@cloud-frame.com",
								"gaojuan@cloud-frame.com",
								"zhouyao@cloud-frame.com",
								"guql@cloud-frame.com",
								"yuanjh@cloud-frame.com",
								"liyang@cloud-frame.com",
								"zhengfeng@cloud-frame.com",
								"zhanglei@cloud-frame.com",
								"dingjian@cloud-frame.com",
								"donglc@cloud-frame.com",
								"wujie@cloud-frame.com",
								"zhangming@cloud-frame.com",
								"wuyz@cloud-frame.com",
								"chengjg@cloud-frame.com",
								"wuzj@cloud-frame.com",
								"hecm@cloud-frame.com",
								"liuli@cloud-frame.com",
								"gebb@cloud-frame.com",
								"liuxq@cloud-frame.com",
								"zhangps@cloud-frame.com",
								"wanghy@cloud-frame.com",
								"fanxw@cloud-frame.com",
								"zhangjin@cloud-frame.com",
								"sundl@cloud-frame.com",
								"liujl@cloud-frame.com",
								"yuqiang@cloud-frame.com",
								"meilj@cloud-frame.com",
								"mengzb@cloud-frame.com",
								"xugang@cloud-frame.com",
								"jiazheng@cloud-frame.com",
								"wuhz@cloud-frame.com",
								"yinzl@cloud-frame.com",
								"huangyd@cloud-frame.com",
								"huajf@cloud-frame.com",
								"xunf@cloud-frame.com",
								"zhuwj@cloud-frame.com",
								"linyan@cloud-frame.com",
								"chenyz@cloud-frame.com",
								"liuniu@cloud-frame.com",
								"liusc@cbcos.com",
								"yao.hongyu@yoyosys.com",
								"zhang.ju@yoyosys.com",
								"li.hai@yoyosys.com",
								"chang.guoqing@yoyosys.com",
								"zhao.jingxin@yoyosys.com",
								"wang.yani@yoyosys.com",
								"zhao.xiaofei@yoyosys.com",
								"wang.qi@yoyosys.com",
								"li.ruoqing@yoyosys.com",
								"li.na@yoyosys.com",
								"sun.xiaoguang@yoyosys.com",
								"zhang.tao@yoyosys.com",
								"david@yoyosys.com",
								"zhong.yuanzhi@yoyosys.com",
								"han.shiqi@yoyosys.com",
								"lin.jin@yoyosys.com",
								"wang.zhiqiang@yoyosys.com",
								"yang.yang@yoyosys.com",
								"wang.jun@yoyosys.com",
								"wang.lei@yoyosys.com",
								"liu.lanzhe@yoyosys.com",
								"zhu.haidong@yoyosys.com",
								"chu.xiao@yoyosys.com",
								"liu.kai@yoyosys.com",
								"liu.xiao@yoyosys.com",
								"wang.fengming@yoyosys.com",
								"wei.yong@yoyosys.com",
								"zhou.lichuan@yoyosys.com",
								"gan.qiang@yoyosys.com",
								"pang.zhenzhou@yoyosys.com",
								"ma.zhentao@yoyosys.com",
								"wei.liangwei@yoyosys.com",
								"li.julei@yoyosys.com",
								"liu.guanjun@yoyosys.com",
								"zheng.dongzhe@yoyosys.com",
								"nie.jing@yoyosys.com",
								"ma.jingfei@yoyosys.com",
								"wang.xiaofan@yoyosys.com",
								"han.xuelian@yoyosys.com",
								"guo.chong@yoyosys.com"
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
		$mailer->Username = 'atom_2@myspace.cn';                //认证用户名 
		$mailer->Password = 'panda888';                    //认证密码  
		$mailer->CharSet = 'UTF-8';
		$mailer->Subject  = $subject;				                //邮件标题
		$mailer->Body     =	 $message;                   //邮件正文 
		$mailer->SetFrom('atom_2@myspace.cn', 'Chen, Pengfei');          //设置发件人
		$mailer->AddAddress($email);                 //添加收件人
		return $mailer->Send();
	}
}

?>
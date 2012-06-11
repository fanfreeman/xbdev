<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>学这儿 - 登陆</title>
<base href="<?php echo Yii::app()->request->hostInfo, dirname(Yii::app()->homeUrl); ?>/" />
<link href="/css/base.css" rel="stylesheet" type="text/css">
<link href="/css/common.css" rel="stylesheet" type="text/css">
<link href="<?php echo  Yii::app()->Theme->baseUrl; ?>/css/login.css" rel="stylesheet" type="text/css">
	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript"> 
    DD_belatedPNG.fix('.png');
    </script> 
    <![endif]-->
	<!–-[if lt IE 9]> 
	<script src="/js/html5.js"></script> 
	<![endif]–->

</head>

<body>
<article class="loginBox">
 <header></header>
 <?php echo $content; ?>
</article>
<div class="hiddenDiv"></div>
</body>
</html>

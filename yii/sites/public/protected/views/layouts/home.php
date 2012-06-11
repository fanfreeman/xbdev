<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学这儿 - 首页</title>
<base href="<?php echo Yii::app()->homeUrl ?>" />
	<link href="/css/base.css" rel="stylesheet" type="text/css">
	<link href="/css/common.css" rel="stylesheet" type="text/css">
	<link href="/css/home.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" charset="utf-8" src="/js/jQuery/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/js/jQuery/jQuery.Atom.js"></script>
	<!–[if lt IE 9]> <script src="/js/html5.js"></script>
	<![endif]–>
	<script src="/js/html5.js"></script> 
	<![endif]–->
</head>
<body>
<!--  S=commonHeader  -->
<?php $this->widget('CommonHeader',array('current_page'=>'file')); ?>
    <div class="atom_content">
    <?php 
	echo $content; 
	?>
    </div>
</body>
</html>

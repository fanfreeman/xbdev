<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="" />
<meta name="author" content="xuchen" />
<title>学这儿 - 收件箱</title>
<!--<base href="http://127.0.0.1:8020" />-->
<link href="css/base.css" rel="stylesheet" type="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/message.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jQuery-1.7.min.js"></script>
<script type="text/javascript" src="js/jQuery/atom.message.js"></script>
<script type="text/javascript" src="js/jQuery/message.js"></script>
<![endif]-->
<!–[if lt IE 9]> 
<script src="js/html5.js"></script> 
<![endif]–>
</head>
<body>
<!--  S=commonHeader  -->
<?php $this->widget('CommonHeader',array('current_page'=>'message')); ?>
<!--  E=commonHeader  -->

        	<?php echo $content; ?>

</body>
</html>

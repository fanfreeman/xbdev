<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- blueprint CSS framework -->
    <base href="<?php echo Yii::app()->homeUrl ?>" />
	<link rel="stylesheet" type="text/css" href="/css/base.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="/css/common.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="/css/login.css" media="screen, projection" />
    <script type="text/javascript" charset="utf-8" src="/js/jQuery/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/js/jQuery/jQuery.Atom.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript"> 
    DD_belatedPNG.fix('.png');
    </script> 
    <![endif]-->
	<!–[if lt IE 9]> 
	<script src="/js/html5.js"></script> 
	<![endif]–>
    <script>
    	 $(document).ready(function() {
			$("#loginMain").atomFly({ type : "fadeIn", isMask : false});	 
			if($("#allLogo").width() < 1400){
				$("#allLogo").children(".img").width($("#allLogo").width());
			}
			$(window).resize(function(){
				$("#loginMain").atomFly({ type : "fadeIn", isMask : false});	 
				if($("#allLogo").width() < 1400){
					$("#allLogo").children(".img").width($("#allLogo").width());
				}
			});
		});
    </script>
	<title>学这儿 - 登陆</title>
</head>
<body>
<?php echo $content; ?>
</body>
</html>

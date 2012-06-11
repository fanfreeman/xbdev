<!DOCTYPE HTML>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>学这儿 - 个人资料</title>
<base href="<?php echo Yii::app()->homeUrl ?>" />
<link href="css/base.css" rel="stylesheet" type="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/profile.css" media="screen, projection" />
    <script type="text/javascript" charset="utf-8" src="js/jQuery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jQuery/jQuery.Atom.js"></script>
	<script type="text/javascript" src="js/jQuery/profile.js"></script>
	<!–[if lt IE 9]> <script src="js/html5.js"></script>
	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript"> 
    DD_belatedPNG.fix('.png');
    </script> 
    <![endif]-->
	<!–-[if lt IE 9]> 
	<script src="js/html5.js"></script> 
	<![endif]–->

</head>

<body>
<!--  S=commonHeader  -->
<?php $this->widget('CommonHeader',array('current_page'=>'directory')); ?>
<!--  E=commonHeader  -->
<!--  S=profileHead  -->
<header id="profileHead">
    <section id="profileReturnDirectory" class="fl"><a href="/index.php?r=directory" title="return directory"></a></section>
    <aside id="profileStatus" class="fr">online</aside>
</header>
<!--  E=profileHead  -->
<?php echo $content; ?>
</body>
</html>
<script>
$('.button_follow_status').click(function(){
	var following_id = $(this).attr('item_id');
	//alert(following_id);
	$.ajax({
		type : "get",
		url : "index.php?r=Follows/FollowStatus",
		data : {following_id : following_id},
		dataType : "json",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			if(json.success)
			{
				if(json.type=='deleteFollow'){$('.button_follow_status').html('no');}
				else if (json.type=='addFollow'){$('.button_follow_status').html('yes');}
				//alert(json.type);
			}
			else
			{
				console.log(json.error);
				//alert(json.error);
			}
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
		},
		error: function (json)
		{
			//alert(json.error);
		}
	});
	});
</script>

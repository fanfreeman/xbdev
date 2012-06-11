<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="" />
<meta name="author" content="xuchen" />
<title>Myspace-Message</title>
<!--<base href="http://127.0.0.1:8020" />-->
<link href="css/base.css" rel="stylesheet" type="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/message.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jQuery-1.7.min.js"></script>
<script type="text/javascript" src="js/jQuery/atom.Message.js"></script>
<script type="text/javascript" src="js/jQuery/message.js"></script>
<![endif]-->
<!–[if lt IE 9]> 
<script src="js/html5.js"></script> 
<![endif]–>
</head>
<body>
修改 IphoneController 的 id_user
</body>
</html>
<script>
function checkMessages()
{
	$.get("index.php?r=iphone/LoadCheckMessage", function(html)
	{
		if(html)
			{
				var tst=eval("("+html+")"); 
				var str_allmembers = tst.arrat_json.str_allmembers;
				{
				var message_group_id = tst.arrat_json.message_group_id;
				var last_message_id = tst.arrat_json.last_message_id;
				$.get("index.php?r=iphone/GetNoreadMessage&message_group_id="+message_group_id+"&last_message_id="+last_message_id,function(json)
					{
					alert(json);
					});
				}
				
		}
	});
}
checkMessages();
</script>
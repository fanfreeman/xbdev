<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="" />
	<meta name="author" content="xuchen" />
	<title>IM</title>
	<link href="css/base.css" rel="stylesheet" type="text/css">
	<link href="css/common.css" rel="stylesheet" type="text/css">
	<link href="css/file.css" rel="stylesheet" type="text/css">
    <link href="css/im.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jQuery-1.7.min.js"></script>
    <script type="text/javascript" src="js/jQuery/jQuery.UI.js"></script>
    <script type="text/javascript" src="js/jQuery/UI.js"></script>
    <script type="text/javascript" src="js/jQuery/jQuery.Atom.js"></script>
        <script type="text/javascript" src="js/jQuery/im.js"></script>
         <script type="text/javascript" src="js/realTime.js"></script>
	<!–[if lt IE 9]> <script src="js/html5.js"></script>    
	<![endif]–>
</head>
<body>
<article id="imFix">Friends(<?php echo bizIm::countListChater(); ?>)</article>
<article id="imUserList">
	<header>
    	<h6 class="fl">friends online(<?php echo bizIm::countListChater(); ?>)</h6>
        <span class="fr">_</span>
    </header>
    <section class="userList">

    </section>
    <section class="userSearch">
    	<div>
        	<input type="text" class="searchText fl" value="" placeholder="write name" />
            <input type="button" class="searchBtn fr" value="" />
        </div>
    </section>
</article>
<!--  E=Fix IM UserList  -->
<!--  S=Fix MessageWin  -->
<div id="imTurnLeft"></div>
<article id="imMessageBox">
    <div id="imMessageList">
    </div>
</article>
<div id="imTurnRight"></div>
<!--  E=Fix MessageWin  -->
<!--  E=IM  -->
<script>
var CONTROLLER_URL = "/index.php?r="; 
loadListChater();
function loadListChater()
	{
		$.get(CONTROLLER_URL+"Im/LoadListChater", function(result)
			{
				//alert(result);
				$("#imUserList .userList").html(result);
			});
	} 
IMPosition(true);
$("#imTurnLeft").click(function(){
	if(!$("#imMessageList").is(":animated")){
		$(".imMessageBlock[alt=win]:visible").find(".on").click();
		$("#imMessageList").animate({right: "-=" + 267},function(){
			IMShow();
			IMBtn();
		});
	}
});
$("#imTurnRight").click(function(){
	if(!$("#imMessageList").is(":animated")){
		$(".imMessageBlock[alt=win]:visible").find(".on").click();
		$("#imMessageList").animate({right: "+=" + 267},function(){
			IMShow();
			IMBtn();
		});
	}
});
$(".sendText").live("paste cut keydown keyup focus blur", function(e){
	var oThis = $(this);
	var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
	//alert("js-ok");
	var height,style=this.style;
	this.style.height = '26px';
	if(keyCode !=13){  
		if (this.scrollHeight > 26) {
			if (156 && this.scrollHeight > 156) {
				height = 156;
				style.overflowY = 'scroll';
			} else {
				height = this.scrollHeight;
				style.overflowY = 'hidden';
			}
			style.height = height  + 'px';
		}	
	} 
	if(keyCode ==27){  	
		oThis.parents(".imMessageBlock").find(".closeIM").click();
	} 
	if(keyCode ==9){  
		e.preventDefault();
		var oBlock = $(".imMessageBlock[alt="+oThis.parents(".imMessageBlock").prev().attr("id")+"]");
		if(oBlock.next().length > 0){ IMMove(oBlock);}
	}
});
$(".off").live("click", function(){
	var oThis = $(this);
	var oBlock = oThis.parents(".imMessageBlock");
	var oWin = $("#" + oBlock.attr("alt"));
	$(".imMessageBlock[alt=win]:visible").not(oWin).find(".on").click();
	oBlock.css("visibility", "hidden").children("header").removeClass("imMessageHeadTips");
	
	oWin.show().css({"position" : "fixed", "bottom" : "0", "left" : oBlock.offset().left -5});
	oWin.children("div.scaleBlock").slideDown("fast");
	message_group_id = oBlock.attr("item_id");
	scrolldown(message_group_id);
	oWin.find(".sendText").focus();
});
$(".on").live("click", function(){
	var oThis = $(this);
	var oWin = oThis.parents(".imMessageBlock");
	var oBlock = $(".imMessageBlock[alt=" + oWin.attr("id") +"]");
	oWin.children("div.scaleBlock").slideUp("fast",function(){
		oWin.hide();
		oBlock.css("visibility", "visible");
	});
});
$(".closeIM").live("click", function(){
	//alert("js-ok");
	var oThis = $(this);
	var oB = oThis.siblings("h6");
	var oBlock, oWin, n =0;
	if(oB.hasClass("off")){
		oBlock = $(this).parents(".imMessageBlock");
		oWin = $("#" + oBlock.attr("alt")); 
	}else{
		oWin = $(this).parents(".imMessageBlock"); 
		oBlock = $(".imMessageBlock[alt=" + oWin.attr("id") +"]");
	}
	n = oBlock.nextAll().length;
	oBlock.remove();
	oWin.hide();
	//alert(n);
	if( n> 0){
		oWin.nextAll(":visible").animate({left: "+=" + 267});
	}
	oWin.remove();
	IMShow();
	IMBtn();
	//
});
$("#imFix").click(function(){
	//alert("js-ok");
	//$(this).slideUp();
	$(this).slideUp("fast", function(){$("#imUserList").slideDown();});
});
$("#imUserList header>span").click(function(){
	$("#imUserList").slideUp("fast", function(){$("#imFix").slideDown();});
});
//选择user自动补全功能
//	$("dd.messageNameBox").NameList({text : "input.messageName", listClass : "nameList"});
var newmessage_session = new Array();
function checkMessages()
{
	$.get("index.php?r=Message/LoadCheckMessage", function(html)
	{
		if(html)
			{ 
				var tst=eval("("+html+")"); 
				var message_group_id = tst.array_json[0].message_group_id;
				var last_message_id = tst.array_json[0].last_message_id;
				var last_message_message = tst.array_json[0].last_message_message;
				if($("#imBlock" + message_group_id).length ==0)
				{
				//$(".imMessageBLock[alt="+message_group_id+"]").;
				var oThis = $(this);
				var html = hWin ="";
				var nID = message_group_id;
				var oBlock,isShow;
					$.get(CONTROLLER_URL+"Im/LoadWindowsChater&message_group_id="+nID, function(result)
					{
					$(result).appendTo("body");
					//	$(messages).appendTo('#ul_chatlist'+nID);
						scrolldown(nID);
						$("#imBlock" + nID).hide();
						newmessage_session.remove(message_group_id);
						$(".imMessageBlock"+message_group_id+" header").addClass("imMessageHeadTips");
					});	
				}
				else
				{
					$.get(CONTROLLER_URL+"Im/GetNoreadMessage&message_group_id="+message_group_id+"&last_message_id="+last_message_id,function(newmessages){
							$("#ul_chatlist"+message_group_id).append(newmessages);
							scrolldown(message_group_id);
							if($("#imBlock" + message_group_id).is(":hidden")) {$(".imMessageBlock"+message_group_id+" header").addClass("imMessageHeadTips"); }
						});
				
				}
			}
	});
setTimeout(checkMessages, 1000 );
}
checkMessages();
</script>
</body>
</html>

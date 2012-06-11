<!--  S=IM  -->
<!--  S=Fix IM UserList  -->
<article id="imFix">Friends(<?php echo bizIm::countListChater(); ?>)</article>
<article id="imUserList">
	<header>
    	<h6 class="fl">friends(<?php echo bizIm::countListChater(); ?>)</h6>
        <span class="fr">_</span>
    </header>
    <section class="userList">
	<ul>
	<?php
    foreach ($data as $chater)
    {
    ?>
        <li item_id="<?php echo $chater['user_id'];?>">
        	<span item_id="<?php echo $chater['user_id'];?>" class="offline"></span>
            <img src="<?php echo $chater['avatar'];?>" class="userPhoto fl" alt="" />
            <p class="userName fl Rows"><?php echo $chater['firstname'].' '. $chater['lastname'];?></p>
        </li>
    <?php
    }
    ?>
</ul>
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
$("#imUserList").find(".searchText").atomSearchList({ searchList : "#imUserList ul", type : "im"});
var CONTROLLER_URL = "/index.php?r="; 
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
$(".scaleBlock").find(".sendText").live("paste cut keydown keyup focus blur", function(e){
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
	if($("#imTurnRight").is(":visible")){
		$("#imTurnRight").click();
	}
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

checkMessages();

$("section.userList ul").children("li").click(function(){
	var id_chater = $(this).attr("item_id");
	imAjax('LoadCreatMessage_group','get',"/Im/LoadCreatMessage_group",{id_chater : id_chater});
});
</script>

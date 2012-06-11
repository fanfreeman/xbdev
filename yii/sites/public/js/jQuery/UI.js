$(document).ready(function() {
	//Newsfeed左侧列表悬停换色
	$(".newsfeed_list li").hoverChangeCss({
		ClassName : "current"
	});
	//Notification弹出窗口
	//$(".msg").directionPopUp({ ShowBox:".notification", Direction:"zoom"});
	//newsfeed页面publish弹出
	$(".addNewsfeed").directionPopUp({
		ShowBox : ".publishBox",
		Direction : "top"
	});
	//newsfeed页面回复弹出
	//$(".newsfeed_list li").directionPopUp({
	//ShowBox : ".feed_reply",
	//Direction : "top"
	//});
	//newsfeed页面类目弹出
	$(".categoryList").directionPopUp({
		ShowBox : ".category",
		Direction : "top",
		AutoClose : true
	});
	//newsfeed页面关闭回复窗口
	$(".close").directionExit({
		ShowBox : ".feed_reply"
	});
	//关闭Notification窗口
	//$("#CloseNotification").directionExit({ ShowBox:".notification", Direction:"bottom"});
	//newsfeed页面关闭publish窗口
	$(".publishBox .btn").directionExit({
		ShowBox : ".publishBox",
		Direction : "top"
	});
	//newsfeed页面类目悬停效果
	$(".categoryList").hoverAddCss({
		ClassName : "categoryHover"
	});
	//newsfeed页面publish窗口text框效果
	$(".publishText").UIText();
	//登录页面text框效果
	$(".loginText").UIText();
	//登录页面checkbox效果
	$(".rememberCheckbox").UICheckbox({
		NormarlClass : "checkBoxShow",
		CheckClass : "selected"
	});
	//注册页面按钮效果
	//$(".registerBtnLink").UIButton({
	//		hoverCss : "registerBtnHover",
	//		clickCss : "registerBtnClick"
	//	});
	//窗口改变时动作
	$(window).resize(function() {
		AutoHeight("#feed_reply_scroll", "200", true);
	});
	//AutoHeight("#feed_reply_scroll", "188", true);

	document.onkeydown = function(event) {
		event = event || window.event;
		//IE suckes
		if(event.keyCode == 65 && event.ctrlKey) {
			//alert(event.keyCode);
			return false;
		}

	}
	
	//进入director 临时路径
$(".search_btn").click(function(){
     location.href = "index.php?r=directory/index";
									  });
});
//添加页面滚动条
function addScroll(obj, hieght) {
	//alert("js-ok");
	var nWinHeight, nObjHeight;
	nWinHeight = $(window).height();
	//alert(nWinHeight);
	nObjHeight = nWinHeight - hieght;
	//alert(nObjHeight);
	$(obj).css("height", nObjHeight + "px");
	//$(obj).Scroll({
	//	MaxHeight : nObjHeight
	//});
}

function AutoHeight(obj, h, isScroll) {
	var nWinHeight, nObjHeight;
	nWinHeight = $(window).height();
	//alert(nWinHeight);
	nObjHeight = nWinHeight - h;
	//alert(nObjHeight);
	//$(".msg").text(nObjHeight);
	$(obj).css("height", nObjHeight + "px");
	//if(isScroll) {
		//$(obj).Scroll({
		//	MaxHeight : nObjHeight
		//});
	//}
}
function ReturnHeight(h) {
	var nWinHeight, nObjHeight;
	nWinHeight = $(window).height();
	//alert(nWinHeight);
	nObjHeight = nWinHeight - h;
	alert(nObjHeight);
	return nObjHeight;
}

//notification飞出
function notification_flyinto(ajax_url){
		   if ($('.notification').is(':visible')) {
			   return false;
		   }
	       $('.notification').remove(); 
			$.get(ajax_url, function(result){
			 $('body').append(result);
				FlyInto($(".notification"));
			  });	
	}
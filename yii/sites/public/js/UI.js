$(document).ready(function() {
  $(".newsfeed_list li").hoverChangeCss({ ClassName:"current"});
  $(".msg").directionPopUp({ ShowBox:".notification"});
  $(".addNewsfeed").directionPopUp({ ShowBox:".publishBox", Direction:"top"});
  $(".newsfeed_list li").directionPopUp({ ShowBox:".feed_reply", Direction:"top"});
  $(".categoryList").directionPopUp({ ShowBox:".category", Direction:"top", AutoClose:true});
  $(".close").directionExit({ ShowBox:".feed_reply"});
  $("#CloseNotification").directionExit({ ShowBox:".notification"});
  $(".publishBox .btn").directionExit({ ShowBox:".publishBox", Direction:"top"});
  $(".loginText").UIText();
  $(".publishText").UIText();
  $(".rememberCheckbox").UICheckbox({NormarlClass:"checkBoxShow", CheckClass:"selected"});
  $(".categoryList").hoverAddCss({ ClassName:"categoryHover"});
  //窗口改变时动作
  $(window).resize(function(){
  	AutoHeight("#feed_reply_scroll", "188", true);
  });
  //AutoHeight("#feed_reply_scroll", "188", true);

 function AutoHeight(obj, h, isScroll){
		var nWinHeight, nObjHeight;
		nWinHeight = $(window).height();
		//alert(nWinHeight);
		nObjHeight = nWinHeight - h;
		//alert(nObjHeight);
		//$(".msg").text(nObjHeight);
		$(obj).css("height" , nObjHeight+"px");
		if(isScroll){
			$(obj).Scroll({MaxHeight:nObjHeight});
		}
	}
});

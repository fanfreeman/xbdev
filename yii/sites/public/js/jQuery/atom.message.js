/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面底层部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */

(function($) {
	$.fn.extend({
		/******************************************************************
		 *	根据页面调整元素宽或者高 obj.atomPageAuto()
		 *	@param [type]	操作方式 [ width | height ] 
		 *	@param [num]	特定需要减去的数值
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomPageAuto": function(options){
			options = $.extend({
				type : "",
				num : 0 ,
				callBack : null 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var oThis = $(this);
				var oWindow = $(document);
				switch (options.type){
					case "width":
						oThis.width(oWindow.width() - options.num);
					break;
					case "height":
						oThis.height(oWindow.height() - options.num);
					break;
					default:
						alert("Param Error");
					break;
				}
			});
		},
		/******************************************************************
		 *	Creat new messages  obj.atomMessageAddNews()
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomMessageCreatMessages": function(options){
			options = $.extend({
				callBack : null 
			}, options);
			return this.click(function(){
				var oSendFrame = $("#senderFrame");
				var oTextLi = $("#peopleText");
				$("#newMessage").siblings().removeClass("selected");
				oSendFrame.children(".senderShow").children("li").not(oTextLi).remove();
				$("#newMessage").slideDown("fast").addClass("selected");
				$("#messageOperation").children(".deleteBtn").hide();
				oSendFrame.next("ul.messageList").html("");
				oTextLi.children(".addPeopleText").focus();
			});
		},
		/******************************************************************
		 *	set messageList height  obj.setMessageListHeight()
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"setMessageListHeight": function(options){
			options = $.extend({
				callBack : null 
			}, options);
			return this.each(function(){
				var oList = $(this);
				var winHeight = $(window).height();
				var nSenderFrame = $("#senderFrame").outerHeight(true);
				var nSendMessage = $("#sendMessageFrame").outerHeight(true);
				var nHeight = winHeight - nSenderFrame  -nSendMessage -78;
				oList.height(nHeight);
			});
		}
		//new
	});
})(jQuery);
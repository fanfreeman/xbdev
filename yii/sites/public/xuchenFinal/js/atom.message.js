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
				var oWindow = $(window);
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
				var oWindow = $(window);
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
				var nHeight = winHeight - nSenderFrame  -nSendMessage -76;
				oList.height(nHeight);
			});
		}
		//new
	});
})(jQuery);

/******************************************************************
 *	自动调整页面高度 atomPageAutoHeight()
 *	@param [obj]	需要调整高度的对象
 *	@param [height]	特定需要减去的高度
 ******************************************************************/

function atomPageAutoHeight(obj, height) {
	var objHeihgt = obj.outerHeight();
	var winHeight = $(window).height();
	obj.height(winHeight - height);
}
/******************************************************************
 *	自动调整页面高度 atomPageAutoWidth()
 *	@param [obj]	需要调整宽度的对象
 *	@param [width]	特定需要减去的宽度
 ******************************************************************/
function atomPageAutoWidth(obj, width) {
	var winWidth = $(window).outerWidth();
	var nWidth = winWidth - width;
	obj.width(nWidth);
}
/******************************************************************
 *	设置两个对象相同高度 atomPageAutoWidth()
 *	@param [obj]	对比对象
 *	@param [another]	另一个对比对象
 ******************************************************************/
function atomSetSameHeight(obj, another) {
	var objHeihgt = obj.outerHeight(true);
	var anotherHeihgt = another.outerHeight(true);
	var nHeight = 0;
	objHeihgt > anotherHeihgt? another.height(objHeihgt) : obj.height(objHeihgt);
}
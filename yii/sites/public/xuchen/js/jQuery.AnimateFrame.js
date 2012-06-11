/*  2011-12-15 滚动条        版本1.0beta
 **  MySpace  底层部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */

(function($) {
	/*
	 **  动画切换框架
	 **
	 */
	$.fn.AnimateFrame = function(options) {
		var defaults = {
			TriggerObj : ".Home>li",   //触发对象
			FrameList : "#FrameList"   //框架列表对象
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			//alert("js-ok");
			var oTrigger = $(options.TriggerObj);
			var oFrameList = $(options.FrameList);
			oTrigger.click(function(){
				Apply($(this));
			});
			function Apply(obj){
				obj.off("click", Apply);
				var sSrc = obj.attr("page");
				var oFrontFrame = oFrameList.children(":first");
				var oBehindFrame = $("<li>",{html:"<iframe src=\""+sSrc+"\"></iframe>"});
				oBehindFrame.insertBefore(oFrontFrame);
				oFrameList.transition({scale:0.8},function(){
					//alert("js-ok");
					oFrontFrame.transition({x:"-50%", y:10}).transition({x:0, y:0},function(){
						oFrontFrame.remove();
					});
					oBehindFrame.transition({x:"50%", y:-10},function(){
						oBehindFrame.css("z-index", "2");
					}).transition({x:0, y:0},function(){
						oBehindFrame.css("z-index", "1");
						oFrameList.transition({scale:1});
						//obj.on("click", Apply);
					});
				});	
			}
		});
	};
})(jQuery);

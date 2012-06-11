/*  2011-12-07 综合项目部分        版本1.0beta
 **  Atom  底层部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */

(function($) {
	
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
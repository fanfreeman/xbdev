﻿/*  2011-12-07 综合项目部分        版本1.0beta
 **  MySpace  底层部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */

(function($) {
	/*
	 **  按钮
	 **	 $(".Input").UIButton({hoverCss:"", clickCss:""});
	 */
	$.fn.UIButton = function(options) {
		var defaults = {
			hoverCss : "InputHover", //按钮悬停时的样式
			clickCss : "inputClick", //按钮点击时的样式
			clickedCss : ""   				//按钮点击后的样式
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oThis = $(this); eHover = options.hoverCss, eClick = options.clickCss;
			eClicked = options.clickedCss;
			oThis.mouseenter(function() {
				//alert("js-ok");
				oThis.addClass(eHover);
				oThis.on("mousedown", function() {
					oThis.addClass(eClick);
					$(document).mouseup(function() {
						//alert("js-ok");
						oThis.removeClass(eClick).removeClass(eHover).addClass(eClicked);
						//oThis.prop("disabled", true);
					});
				});
			}).mouseleave(function() {
				oThis.removeClass(eHover);
			});
		});
	};
	/*
	 **  悬停切换css
	 **  $(".newsfeed_list li").hoverChangeCss({ ClassName:"current"});
	 */
	$.fn.hoverChangeCss = function(options) {
		var defaults = {
			ClassName : "ClassName" //需要切换的ClassName
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oThis = $(this);
			var eClassName = options.ClassName;
			oThis.hover(function() {
				//alert("js-ok");
				oThis.addClass(eClassName).siblings().removeClass(eClassName);
			}, function() {
				oThis.removeClass(eClassName);
			});
		});
	};
	/*
	 **  悬停添加css
	 **  $(".categoryList").hoverAddCss({ ClassName:"categoryHover"});
	 */
	$.fn.hoverAddCss = function(options) {
		var defaults = {
			ClassName : "ObjName" //需要添加的ClassName
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oThis = $(this);
			var eClassName = options.ClassName;
			oThis.hover(function() {
				//alert("js-ok");
				oThis.addClass(eClassName);
			}, function() {
				oThis.removeClass(eClassName);
			});
		});
	};
	/*
	 **  方向弹出
	 **
	 */
	$.fn.directionPopUp = function(options) {
		var defaults = {
			Direction : "", //弹出方向
			ShowBox : "ShowBox", //显示的盒子
			CloseBtn : "", //关闭按钮
			AutoClose : false		//自动关闭
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oThis = $(this);
			var eDirection = options.Direction;
			var eAutoClose = options.AutoClose;
			var oShowBox = $(options.ShowBox);

			//alert(nWidth);
			//alert(nHeight);
			//oShowBox.hide();
			oThis.on("click", function() {
				//alert("js-ok");
				//oShowBox.show();
				switch (eDirection) {
					case "show":
						oShowBox.css("z-index", "10");
						oShowBox.stop(true, true).show("fast");
						break;
					case "top":
						oShowBox.css("z-index", "10");
						oShowBox.stop(true, true).slideDown("fast");
						break;
					case "zoom":
						var nWidth = nHeight = sWidth = sHeight = 0;
						nWidth = oShowBox.outerWidth();
						nHeight = oShowBox.outerHeight();
						sMallWidth = nWidth - 100;
						sMallHeight = nHeight - 100;
						sWidth = ($(window).width() - sMallWidth) / 2;
						sHeight = $(window).scrollTop() + ($(window).height() - sMallHeight) / 3;
						oShowBox.children().hide();
						oShowBox.css({
							width : sMallWidth + "px",
							height : sMallHeight + "px",
							left : sWidth + "px",
							top : sHeight + "px"
						});
						oShowBox.show();
						oShowBox.animate({
							width : nWidth + "px",
							height : nHeight + "px",
							marginTop : "-=50px",
							marginLeft : "-=50px"
						}, 300);
						oShowBox.children().show();
						break;
					case "bottom":
						break;
					default :
						//alert("js-ok");
						//alert(oShowBox.length);
						//oShowBox.hide();
						var nWidth = nHeight = sWidth = sHeight = 0;
						nWidth = oShowBox.outerWidth();
						nHeight = oShowBox.outerHeight();
						sMallWidth = nWidth - 100;
						sMallHeight = nHeight - 100;
						sWidth = ($(window).width() - sMallWidth) / 2;
						sHeight = $(window).scrollTop() + ($(window).height() - sMallHeight) / 3;
						oShowBox.children().hide();
						oShowBox.css({
							width : sMallWidth + "px",
							height : sMallHeight + "px",
							left : sWidth + "px",
							top : sHeight + "px"
						});
						oShowBox.show();
						oShowBox.animate({
							width : nWidth + "px",
							height : nHeight + "px",
							marginTop : "-=50px",
							marginLeft : "-=50px"
						}, 300).animate({
							width : (nWidth - 20) + "px",
							height : (nHeight - 20) + "px",
							marginTop : "+=10px",
							marginLeft : "+=10px"
						}, 200).animate({
							width : nWidth + "px",
							height : nHeight + "px",
							marginTop : "-=10px",
							marginLeft : "-=10px"
						}, 300);
						oShowBox.children().show();
						break;
				}
				oThis.off("click", function() {
					if(oShowBox.is(":hidden")) {
						oThis.on("click");
					}
				});
				//oShowBox.click(function() {
				//	$(this).hide();
				//});
				//oShowBox.animate({
				//	"left" : "590"
				//}, 1200);
			});

			oShowBox.on("hide", function() {
				if($(this).is(":animated")) {
					return false;
				}
				$(this).stop(true, true).fadeOut("fast");
			});
			if(eAutoClose) {
				//alert("js-ok");
				$(document).click(function() {
					oShowBox.trigger("hide");
				});
			}
		});
	};
	/*
	 **  方向退出
	 **
	 */
	$.fn.directionExit = function(options) {
		var defaults = {
			Direction : "Direction", //退出方向
			ShowBox : "ShowBox" //显示的盒子
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oThis = $(this);
			var eDirection = options.Direction;
			var oShowBox = $(options.ShowBox);
			oThis.on("click", function() {
				//alert("js-ok");
				//oShowBox.show();
				switch (eDirection) {
					case "top":
						oShowBox.stop(true, true).slideUp("fast");
						break;
					case "bottom":
						//alert("js-ok");
						var nWidth = nHeight = sWidth = sHeight = wHeight = 0;
						nWidth = oShowBox.outerWidth();
						nHeight = oShowBox.outerHeight();
						sWidth = ($(window).width() - nWidth) / 2;
						sHeight = $(window).scrollTop() + ($(window).height() - nHeight) / 3;
						wHeight = $(window).scrollTop() + $(window).height();
						//alert(sWidth);
						//alert(sHeight);
						//alert(wHeight);
						//alert(obj.css("top"));

						oShowBox.animate({
							marginTop : "+=" + (wHeight - sHeight) + "px"
						}, 300,function(){
							oShowBox.hide();
						});
						break;
					default:
						oShowBox.stop(true, true).fadeOut("fast");
						break;
				}
			});
		});
	};
	/*
	 **  input控件Text特效
	 **
	 */
	$.fn.UIText = function(options) {
		var defaults = {
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oThis = $(this);
			oThis.focus(function() {
				oThis.prev().animate({
					opacity : 0.6
				}, 300);
				oThis.parent("div").attr("class", "InputFocus");
			}).keyup(function() {
				if(oThis.val() == "") {
					oThis.prev().fadeIn(200);
				} else {
					oThis.prev().fadeOut(200);
				}
			}).blur(function() {
				if(oThis.val() == "") {
					oThis.prev().animate({
						opacity : 1
					}, 400);
				} else {
					oThis.prev().animate({
						opacity : 0
					}, 100);
				}
				oThis.parent("div").attr("class", "InputNormarl");
			});
			oThis.keyup();

		});
	};
	/*
	 **  模拟input控件Checkbox
	 **
	 */
	$.fn.UICheckbox = function(options) {
		var defaults = {
			NormarlClass : "NormarlClass", //模拟 Radio的样式
			CheckClass : "CheckClass" //模拟 Radio选中的样式
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			var oCheckbox = $(this);
			var eNormarlClass = options.NormarlClass;
			var eCheckClass = options.CheckClass;
			var hCheckContainer = $("<div>", {
				html : "<span class=\"" + eNormarlClass + "\"></span>"
			});
			hCheckContainer.addClass("UICheckbox");
			var oRadio = hCheckContainer.find("." + eNormarlClass);
			oCheckbox.hide().after(hCheckContainer);
			oRadio.on("click", function() {
				//alert("js-ok");
				if($(this).hasClass(eCheckClass)) {
					$(this).removeClass(eCheckClass);
					oCheckbox.prop("checked", false);
				} else {
					$(this).addClass(eCheckClass);
					oCheckbox.prop("checked", true);
				}
				//alert(oCheckbox.prop("checked"));
			});
		});
	};
		$.fn.extend({//添加滚轮事件//by jun
		mousewheel : function(Func) {
			return this.each(function() {
				var _self = this;
				_self.D = 0;
				//滚动方向
				if($.browser.msie || $.browser.safari) {
					_self.onmousewheel = function() {
						_self.D = event.wheelDelta;
						event.returnValue = false;
						Func && Func.call(_self);
					};
				} else {
					_self.addEventListener("DOMMouseScroll", function(e) {
						_self.D = e.detail > 0 ? -1 : 1;
						e.preventDefault();
						Func && Func.call(_self);
					}, false);
				}
			});
		}
	});
	/*
	 **  滚动条
	 **	 $(".Box").Scroll();
	 */
	$.fn.Scroll = function(options) {
		var defaults = {
			MaxHeight : ""   //Box的Max高度
		}
		var options = $.extend(defaults, options);

		return this.each(function() {
			//alert("js-ok");
			var oBox = $(this);
			var eMaxHeight = options.MaxHeight;
			var nBoxHeight = nBoxMaxHeight = nScrollHeight = nProportion = 0;
			var nChildLength = oBox.children().length;
			if($(".ScrollWrap").length == 1) {
				nChildLength = 1;
			}
			nBoxMaxHeight = oBox.outerHeight(true);
			if(nBoxMaxHeight >= eMaxHeight) {
				nBoxMaxHeight = eMaxHeight;
				for(var i = 0; i < nChildLength; i++) {
					nBoxHeight = nBoxHeight + oBox.children().eq(i).outerHeight(true);
				}
				//初始Box的样式
				if(nBoxMaxHeight >= nBoxHeight) {
					$(".ScrollBox").parent().remove();
					$(".ScrollWrap").css("top", "0px");
					return false;
				}
				oBox.css({
					height : nBoxMaxHeight + "px",
					position : "relative",
					overflow : "hidden"
				});
				//给内容包裹控制层
				if($(".ScrollWrap").length == 0) {
					oBox.children().wrapAll("<div class=\"ScrollWrap\" />");
				}
				var oScrollWrap = oBox.find(".ScrollWrap");
				oScrollWrap.css("position", "absolute");
				var hScrollBox = $("<div>", {
					css : {
						position : "absolute",
						top : "0",
						right : "0"
					},
					html : "<div class=\"ScrollBox\"><div class=\"Scroll\"></div></div>"
				});
				nProportion = nBoxMaxHeight / nBoxHeight;
				nScrollHeight = nProportion * nBoxMaxHeight;
				if($(".ScrollBox").length == 0) {
					//alert("js-ok");
					oBox.append(hScrollBox);
				}

				var oScrollBox = oBox.find(".ScrollBox");
				var oScroll = oScrollBox.find(".Scroll");
				//alert(nBoxMaxHeight);
				oScrollBox.css("height", nBoxMaxHeight + "px");
				oScroll.css("height", nScrollHeight + "px");
				oBox.hover(function() {
					oScrollBox.show();
				}, function() {
					oScrollBox.hide();
				});
				var nBoxTop = oBox.offset().top;
				oScroll.on("mousedown", function(e) {
					var ePageY = e.pageY, nScrollTop = parseInt(oScroll.position().top);
					$(document).mousemove(function(e2) {
						ScrollMove((nScrollTop + e2.pageY - ePageY), (nBoxMaxHeight - nScrollHeight));
					});
					$(document).mouseup(function() {
						$(document).off("mousemove");
					});
					return false;
				});
				oBox.mousewheel(function() {
					//alert(this.D);
					if($(".ScrollBox").length == 1) {
						if(this.D > 0) {
							RollMove("-50", (nBoxMaxHeight - nScrollHeight))
						} else {
							RollMove("50", (nBoxMaxHeight - nScrollHeight));
						}
					}
				});
			}
			function ScrollMove(y, maxHeight) {
				//alert("js-ok");
				y = y < 0 ? 0 : y;
				y = y > maxHeight ? maxHeight : y;
				//alert(y);
				oScroll.css("top", y);
				oScrollWrap.css("top", -y / nBoxMaxHeight * nBoxHeight);
			}

			function RollMove(y, maxHeight) {
				var nMoveTop;
				nMoveTop = oScroll.position().top;
				y = (parseInt(y) + parseInt(nMoveTop)) > maxHeight ? (parseInt(maxHeight) - parseInt(nMoveTop)) : y;
				if(y < 0) {
					y = (parseInt(y) + parseInt(nMoveTop)) < 0 ? -parseInt(nMoveTop) : y;
				}
				oScroll.animate({
					top : parseInt(y) + parseInt(nMoveTop)
				}, 100);
				oScrollWrap.animate({
					top : parseInt(oScrollWrap.position().top) - parseInt(y / nBoxMaxHeight * nBoxHeight)
				}, 100);
			}

		});
	};
})(jQuery);
/*
 **  newsfeed页面添加新item
 */
function addNewItem(html, list) {
	var hHtml = html;
	var oList = list;
	oList.prepend(hHtml);
	//oList.children(":first").slideDown("fast");
}

/*
 **  Notification弹出效果
 */
function FlyInto(obj) {
	//alert("js-ok");
	var nWidth = nHeight = sWidth = sHeight = wHeight = 0;
	nWidth = obj.outerWidth();
	nHeight = obj.outerHeight();
	sWidth = ($(window).width() - nWidth) / 2;
	sHeight = $(window).scrollTop() + ($(window).height() - nHeight) / 3;
	wHeight = $(window).scrollTop() + $(window).height();
	//alert(sWidth);
	//alert(sHeight);
	//alert(wHeight);
	//alert(obj.css("top"));
	obj.css({
		left : sWidth + "px",
		top : wHeight + "px"
	});
	obj.show();
	obj.animate({
		marginTop : "-=" + (wHeight - sHeight) + "px"
	}, 300);
}

function FlyOut(obj) {

}
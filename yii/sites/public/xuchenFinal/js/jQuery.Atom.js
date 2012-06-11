/*  2011-12-07 综合项目部分        版本1.0beta
 **  Atom  底层部分             联系邮箱：xuchen011@sina.com
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
		 *	根据页面一行可容纳li的个数调整元素宽度 obj.setListMain() 每个元素宽157
		 *	@param [liWidth]	每个元素宽
		 *	@param [Reference]	参照元素
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"setListMain": function(options){
			options = $.extend({
				liWidth : 157,
				Reference : "#fileMain",
				callBack : null 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var n = parseInt($(options.Reference).width() / options.liWidth);
				$(this).width(n * options.liWidth);
			});
		},
		/******************************************************************
		 *	公用弹出层 obj.atomPop() 
		 *	@param [type]	
		 *	@param [maskID]	遮罩层ID
		 *	@param [popClass]	pop window class [null | class]
		 *	@param [headerText]	header text
		 *	@param [headerClass]	header class [null | class]
		 *	@param [isTips]	是否为提示 [ true | false ]
		 *	@param [content]	内容
		 * 	@param [hasCancel]	是否需要cancel按钮 [ true | false] 
		 *	@param [done]	确定函数
		 * 	@param [cancel]	取消函数 
		 *	@param [callback]	回调函数
		 ******************************************************************/
		"atomPop": function(options){
			options = $.extend({
				type : "in",
				maskID : "UIMask",
				popClass : null,
				headerText : "",
				headerClass : null,
				isTips : true,
				content : "",
				hasCancel : true,
				done : function(){}, 
				cancel : function(){},
				callback : function(){} 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var $this = $(this);			
				var $tips = $("#tipsPop");
				var $head = $tips.find("header");
				var $content = $tips.find(".content");
				var $done = $tips.find(".done");
				var $cancel = $tips.find(".cancel");
				var $close = $tips.find(".closePopIcon");
				var oWin = $(window);
				//遮罩层
				var maskAttr = { width : oWin.width(), height : $(document).height()};
				var hMask = $("<div>", {
					width: maskAttr.width,
					height: maskAttr.height,
					id: options.maskID
				});
				//append the mask
				$("body").append(hMask);
				$("#" + options.maskID).fadeIn();
				//set $tips information
				if(options.popClass){ $tips.addClass(options.popClass); }
				if(options.headerClass){ $head.addClass(options.headerClass); }
				$head.text(options.headerText);
				if(options.isTips){
					$content.css({
						"width":"500px",
						"padding":"20px",
						"font":"700 12px/30px Arial, Helvetica, sans-serif",
						"color":"#666"
					});
					$content.text(options.content); 
				}
				else {
					$content.removeAttr("style");
					$content.html(options.content);
				}
				var objAttr = { width : $tips.outerWidth(), height : $tips.outerHeight()};
				var position = { left :  (oWin.width() - objAttr.width) / 2, top : (oWin.height() - objAttr.height) / 3};
				$tips.css({
					left : position.left + "px",
					top : position.top + "px"
				});
				//	set click function
				//	has cancel button
				$done.off("click");
				$cancel.off("click");
				$close.off("click");
				if(options.hasCancel){
					$cancel.show();
					$done.on("click", function(){
						options.done();
					});	
					$cancel.on("click", function(){
						_closeAtomPop()
					});
					$close.on("click", function(){
						_closeAtomPop()
					});
				}
				//	has not cancel button
				else {
					$cancel.hide();
					$done.on("click", function(){
						_closeAtomPop()
					});	
					$close.on("click", function(){
						_closeAtomPop()
					});
				}
				$tips.fadeIn().css("zIndex", "100");;
				//close tips
				function _closeAtomPop(){
					$("#UIMask").fadeOut("fast", function(){	$("#UIMask").remove();});
					//$("#UIMask").remove();
					$tips.fadeOut(function(){
						//$tips.remove();
						if(options.popClass){ $tips.removeClass(options.popClass); }
						if(options.headerClass){ $head.removeClass(options.headerClass); }
						options.cancel();
					});
				}
			});
		},
		/******************************************************************
		 *	弹出层飞行效果 obj.atomFly() 
		 *	@param [type]	飞入或飞出 [ in | out ]
		 *	@param [isMask]	是否使用遮罩层 [ true | false]
		 *	@param [tips]	提示信息
		 *	@param [zIndex]	显示优先级
		 *	@param [maskID]	遮罩层ID
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomFly": function(options){
			options = $.extend({
				type : "tips",
				isMask : true,
				tips : "",
				zIndex: 100,
				maskID : "",
				callBack : function(){} 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var $this = $(this);
				var $win = $(window);
				//reset attr
				var objAttr, position, dataMask;
				switch (options.type) {
					case "fadeIn":
						objAttr = { width : $this.outerWidth(), height : $this.outerHeight()};
						position = { left :  ($win.width() - objAttr.width) / 2, top : ($win.height() - objAttr.height) / 3};
						if(options.isMask){ maskIn(); }
						$this.css({
							left : position.left + "px",
							top : position.top + "px",
							zIndex : options.zIndex
						}).fadeIn();
					break;
					case "fadeOut":
						dataMask = $("body").data("mask");
						if( dataMask != null ) {
							$("#" + dataMask).fadeOut(function(){ $(this).remove();});
						}
						$this.fadeOut(function(){
							$this.removeAttr("style").hide();
							options.callBack();
						});
					break;
					case "center":
						objAttr = { width : $this.outerWidth(), height : $this.outerHeight()};
						position = { left :  ($win.width() - objAttr.width) / 2, top : ($win.height() - objAttr.height) / 2};
						$this.css({
							left : position.left + "px",
							top : position.top + "px",
							zIndex : 100
						});
						$this.fadeIn();
					break;
					case "loading":
						if(options.isMask){ maskIn(); }
						var hLoading = $("<div>", {
							id : "atomLoading"
						});
						objAttr = { width : $(hLoading).outerWidth(), height : $(hLoading).outerHeight()};
						position = { left :  ($win.width() - objAttr.width) / 2, top : ($win.height() - objAttr.height) / 2};
						$(hLoading).css({
							left : position.left + "px",
							top : position.top + "px",
							zIndex : 100
						}).appendTo('body').fadeIn();
					break;
					case "tips":
						var hTips = $("<div>", {
							html : options.tips
						}).css({
							position : "fixed",
							display : "none",
							padding : "5px 20px",
							"background-color" : "#fff7da",
							"font-size" : "12px",
							color : "#666",
							"border" : "1px solid #d3b07f",
							"border-radius" : "5px",
							"box-shadow" : "0 1px 5px #999",
							zIndex : "110"
						}).text(options.tips).appendTo("body");
						objAttr = { width : $(hTips).outerWidth(), height : $this.outerHeight()};
						position = { left :  ($win.width() - objAttr.width) / 2, top : ($win.height() - objAttr.height) / 2};
						$(hTips).css({
							left : position.left + "px",
							top : "35px"
						}).fadeIn("fast").delay(1200).fadeOut("normal");
					break;
					default :
					break;
				}
				function maskIn(){
					var time = new Date();
					var nRandom = time.getTime().toString() + parseInt(Math.random()*100);
					var hMask = $("<div>", {
						width : $win.width(),
						height : $(document).height(),
						id : nRandom
					}).css({
						position : "fixed",
						left : 0,
						top : 0,
						display : "none",
						"background-color" : "#000",
						opacity: 0.2,
						zIndex : "20"
					});
					dataMask = $("body").data("mask");
					if( dataMask != null ) { $("#" + dataMask).remove(); }
					$(hMask).appendTo('body').fadeIn();
					$("body").data("mask", nRandom);
				}
			});
		},
		/******************************************************************
		 *	弹出层iframe obj.atomIframePop() 
		 *	@param [header]	提示信息
		 *	@param [zIndex]	显示优先级
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomIframePop": function(options){
			options = $.extend({
				header : "iframeName",
				url : "",
				zIndex: 102,
				callBack : function(){} 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var $this = $(this);
				var $win = $(window);
				var attr = { width : $win.width() -50, height : $win.height() -100 };
				console.log(attr.width, attr.height);
				var hPop ="<article class=\"commonPop popWindow\" style=\"top : 50px; left: 25px; z-index : " + options.zIndex + "\"><span class=\"closePopIcon\"></span><header>" + options.header + "</header><section class=\"content\" style=\" width : " + attr.width + "px; height : " + attr.height + "px;\"><iframe src=\"" + options.url + "\" width=\"99%\" height=\"99%\" /></iframe> </section></article>";
				
				$(hPop).appendTo("body").fadeIn();
				$(hPop).find(".closePopIcon").click(function(){
					$(hPop).fadeOut(function(){ $(this).remove();});
				});
			});
		},
		/******************************************************************
		 *	search people obj.atomSearchPeople()
		 *	@param [type]	操作方式 [ directoryShare | fileShare] 
		 *	@param [uid]	user id
		 *	@param [peopleShow]	peopleList
		 *	@param [searchText]	查询输入框
		 *	@param [addBtn]	添加按钮
		 *	@param [storage]	people hidden
		 *	@param [userList]	userList
		 *	@param [returnNum]	retuen user number
		 *	@param [operationsUrl]	操作链接
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomSearchPeople": function(options){
			options = $.extend({
				type : "",
				uid : "",
				peopleShow : ".addPeopleShow",
				searchText : ".addPeopleText",
				addBtn : ".addPeopleBtn",
				storage : ".hiddenPeople",
				userList : ".completionUserList",
				returnNum : "5",
				operationsUrl : "",
				callBack : null 
			}, options);
			return this.each(function(event){
				//alert("js-ok");
				var oThis = $(this);
				var oPeopleList = oThis.children("ul" + options.peopleShow);
				var oTextLi = oPeopleList.children(".textLi");
				var oText = oTextLi.children(options.searchText);
				var oBtn = oThis.children(options.addBtn);
				var oHidden = oThis.children(options.storage);
				var oUserList = oThis.find(options.userList);
				var nNum = options.returnNum;
				//console.log(oUserList.length);
				//输入searchText
				oText.on("keyup", function(){
					//alert("js-ok");
					
					var str_search = oText.val();
					var keys = {
						enter:  13,
						escape: 27,
						up:     38,
						down:   40,
						array:  [13, 27, 38, 40]
					}
					//oUserList.show();
					var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
					if($.inArray(keyCode, keys.array) !=-1){
						switch (keyCode){
							case keys.up:
								if(oUserList.is(":visible")){
									if (oUserList.children().hasClass("selected")){
										oUserList.children(".selected").prev().addClass("selected").siblings().removeClass("selected");
									}else{
										oUserList.children().eq("0").addClass("selected");
									}
								}
							break;
							case keys.down:
								if(oUserList.is(":visible")){
									if (oUserList.children().hasClass("selected")){
										oUserList.children(".selected").next().addClass("selected").siblings().removeClass("selected");
									}else{
										oUserList.children().eq(0).addClass("selected");
									}
								}
							break;
							case keys.enter:
								if(oUserList.is(":visible")){
									if (oUserList.children().hasClass("selected")){
										oUserList.children(".selected").click();
									}else{
										oUserList.children("li").eq(0).click();
									}
								}else{
									if (options.type == "fileShare"){
										
										//oThis.hide();
									}
								}
							break;
							case keys.escape:
								$("#hiddenCancel").data("close", "true");
								oThis.hide();
							break;
							default :
							break;
						}
					}else{
						if(str_search != ""){
							//console.log("hihi");
							setTimeout(function(){
								oUserList.empty();
								getSearchUserList({uid : options.uid, name : options.type, obj : oThis, url : options.operationsUrl },{str : str_search, num : nNum, userReady : oHidden.val()} , { obj : oHidden, other : $(".hiddenShare")}, {list : oUserList});
							}, 500);
							
						}else{
							oUserList.hide();
						}
					}
				});
				//输入发送人text退格键操作，只能绑定keydown
				switch (options.type) {
					case "directoryShare":
					break;
					case "fileShare":
					break;
					default:
						oText.on('keydown', function(event){
							var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
							if(keyCode == 8) {
								if(oText.val() === ""){
									if(oUserList.is(":visible")){ oUserList.hide(); }
									if(oTextLi.prevAll("li.name").length > 0){
										oTextLi.prev(".name").find(".deleteName").click();
									}
								}
							}
						});
					break;
				}
			});
		},
		/******************************************************************
		 *	directory页面搜索 obj.atomSearchDirectory() 
		 *	@param [Box]	main元素
		 *	@param [numBox]		搜索结果个数
		 *	@param [searchList]	searchList元素
		 *	@param [showList]		showList元素
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomSearchDirectory": function(options){
			options = $.extend({
				Box : "#direcroryMain",
				numBox : "#directoryNumber",
				searchList : ".directoryList",
				showList : "#searchDirectory",
				callBack : null 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var oThis = $(this);
				var oBox = $(options.Box);
				var oNumBox = $(options.numBox).children("span");
				var oSearchList = $(options.searchList);
				var oShowList = $(options.showList);
				var aBlock = [];
				var num = oNumBox.text();
				var str ="";
				oSearchList.children("li").each(function(i) {
					aBlock.push($(this));
					str =$(this).children("aside").children(".userName").children("a").text();
					if (str.match(/[a-zA-Z]+/)){ str = str.toLocaleLowerCase();}
					aBlock[i] = {obj : $(this), name : str};
				});
				//输入字符查找人员
				oThis.on("keyup keydown", function(e){
					var strSearch = oThis.val().trim();
					if (strSearch != ""){
						oShowList.prevAll().hide();
						oShowList.html("").show();
						if (strSearch.match(/[a-zA-Z]+/)){ strSearch = strSearch.toLocaleLowerCase();}
						for (var i = 0; i < aBlock.length ; i++){
							if(aBlock[i].name.indexOf(strSearch)>=0){
							   aBlock[i].obj.clone().appendTo(oShowList);
							}
						}	
						oNumBox.text(oShowList.children("li").length);				
					}
					else{
						oShowList.html("").hide();
						oShowList.prevAll().show();
						oNumBox.text(num);
					}
				});
				
			});
		},
		/******************************************************************
		 *	file页面搜索 obj.atomSearchFile() 
		 *	@param [searchList]	searchList元素
		 *	@param [callBack]	回调函数
		 ******************************************************************/
		"atomSearchList": function(options){
			options = $.extend({
				searchList : "#fileList",
				type: "file",
				callBack : null 
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var oThis = $(this);
				var oSearchList = $(options.searchList);
				var aBlock = [];
				var str ="";
				
				//输入字符查找人员
				
				oThis.on("keyup", function(e){
					oSearchList.children("li").not("#newMessage").each(function(i) {
						switch(options.type){
							case "file":
								str = $(this).children("aside").children(".fileNameInfo").text();
							break;
							case "message":
								str = $(this).children("aside").children("h6").children("a").text();
							break;
							case "im":
								str = $(this).children("p.userName").text();
							break;
							default:
							break;
						}
						if (str.match(/[a-zA-Z]+/)){ str = str.toLocaleLowerCase();}
						aBlock[i] = {obj : $(this), name : str};
					});
					var strSearch = oThis.val().trim();
					if (strSearch != ""){
						switch(options.type){
							case "file":
								clearTimeout($setFileUpdate);
							break;
							default:
							break;
						}
						if (strSearch.match(/[a-zA-Z]+/)){ strSearch = strSearch.toLocaleLowerCase();}
						for (var i = 0; i < aBlock.length ; i++){
							if(aBlock[i].name.indexOf(strSearch)>=0){
							   aBlock[i].obj.show();
							}else{
								aBlock[i].obj.hide();
							}
							
						}				
					}
					else{
						switch(options.type){
							case "file":
								oSearchList.children().show();
								getFileUpdates();
							break;
							case "message":
								oSearchList.children().not("#newMessage").show();
							break;
							case "im":
								oSearchList.children().show();
							break;
							default:
							break;
						}
					}
				});
				
			});
		}
		//new
	});
})(jQuery);
/**************************************************************
 *	Common isVisible(parent, child) 	计算子类是否被父类overflow:hidden影响  true为在父类中
 *	parent : $(sleector)		父类
 *	child : $(sleector)		子类 
 **************************************************************/
function isVisible(parent, child){
	var isShow = true;
	var attribute = { pl : parent.offset().left, pw : parent.outerWidth(), pt : parent.offset().top, ph : parent.outerHeight(), cl : child.offset().left, ct : child.offset().top};
	var postion = { pl : attribute.pl, pr : attribute.pl + attribute.pw, pt : attribute.pt, pb : attribute.pt + attribute.ph, cl : attribute.cl, ct : attribute.ct};
//	alert(postion.cl);
//	alert(postion.pr);
	if ( postion.cl <= postion.pl || postion.cl >= postion.pr || postion.ct < postion.pt || postion.ct > postion.pb) { isShow = false; }
	return isShow;
}
/**************************************************************
 *	Common emptyHidden() 	清空hidden数值
 *  @param obj 需要清空的hidden数组
 **************************************************************/
function emptyHidden(obj){
	var n = obj.length;
	for (var i = 0; i < n; i++){
		obj[i].val("");
	}
}
/******************************************************************
 *	search user  atomGetUser()
 *	@param [type]	操作方式 
 *	@param [users]	users id [ fileShareUsers | shareUsers : users.own + users.others ]
 *	@param [obj]	{ beforeBox : 容器}
 ******************************************************************/
function atomGetUser(type, users, obj){
	var html = "";
	var sUrl = sData = "";
	switch(type) {
		case "directoryShareUsers":
			sUrl = "user/GetUserInfoByArray";
			sData ={ str_array : users.own + users.others};
		break;
		case "fileShareUsers":
			sUrl = "user/GetUserInfoByArray";
			sData ={ str_array : users.own + users.others};
		break;
		case "allShareUsers":
			sUrl = "user/GetUserInfoByArray";
			sData ={ str_array : users.others};
		break;
		default:
		break;
	}
	$.ajax({
		type : "get",
		url : sUrl,
		data : sData,
		dataType : "json",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			//console.log(json);
			if (json != null){
				switch (type) {
					case "directoryShareUsers":
						for ( var i = 0; i < json.length; i++){
							if (users.own.replace("_","") == json[i].user_id ){
								html +="<li class=\"name\"><img src=\"" + json[i].avatar + "\" alt=\"" + json[i].firstname + " " + json[i].lastname + "\" /></li>";
							}else{
								html +="<li class=\"name\"><img src=\"" + json[i].avatar + "\" alt=\"" + json[i].firstname + " " + json[i].lastname + "\" /><a href=\"#\" class=\"deleteName\" title=\"stop sharing this file with " + json[i].firstname + " " + json[i].lastname + "\" nameid=\"" + json[i].user_id + "\"></a></li>";
							}
						}
						obj.beforeBox.prevAll().remove();
						$(html).insertBefore(obj.beforeBox);
					break;
					case "fileShareUsers":
						for ( var i = 0; i < json.length; i++){
							if (users.own.replace("_","") == json[i].user_id ){
								html +="<li class=\"name\"><img src=\"" + json[i].avatar + "\" alt=\"" + json[i].firstname + " " + json[i].lastname + "\" /></li>";
							}else{
								html +="<li class=\"name\"><img src=\"" + json[i].avatar + "\" alt=\"" + json[i].firstname + " " + json[i].lastname + "\" /><a href=\"#\" class=\"deleteName\" title=\"stop sharing this file with " + json[i].firstname + " " + json[i].lastname + "\" nameid=\"" + json[i].user_id + "\"></a></li>";
							}
						}
						obj.beforeBox.prevAll().remove();
						$(html).insertBefore(obj.beforeBox);
					break;
					case "allShareUsers":
						for ( var i = 0; i < json.length; i++){
							for (var j = 0; j < obj.userID.length; j++){
								if( json[i].user_id == obj.userID[j] ){
									html +="<li nameID=\"" + json[i].user_id + "\">";
									html +="<span class=\"tips\">" + obj.shareNum[j] + "</span>";
									html +="<a href=\"#\" target=\"_blank\" title=\"" + json[i].firstname + " " + json[i].lastname + "\"><img src=\"" + json[i].avatar + "\" class=\"userPhoto fl\" alt=\"\" /></a>";
									html +="<aside class=\"fl\">";
									html +="<h6 class=\"Rows\">" + json[i].firstname + " " + json[i].lastname + "</h6>";
									html +="</aside>";
									html +="<div class=\"ClearBoth\"></div>";
									html +="</li>";
								}
							}
						}
						$(html).appendTo(obj.box);
						//show share user's file list
						obj.box.children("li").click(function() {
							clearTimeout($setFileUpdate);
							getFileList({ uid : users.own, shareUsers : $(this).attr("nameID"), url : obj.operationUrl}, "sharingDirectory", {box : $("#fileMain ul.fileList")});
							//getShareFileList(users.own, $(this).attr("nameID"), obj.operationUrl, $("#fileMain ul.fileList"));
						});
					break;
					default :
						for ( var i = 0; i < json.length; i++){
							html +="<li class=\"quickLi\" name=\"" + json[i].firstname + " " + json[i].lastname + "\" nameID=\"" + json[i].user_id + "\">";
							html +="<img src=\"" + json[i].avatar + "\" class=\"userPhoto fl\" alt=\"\" />";
							html +="<p class=\"userName fl\">" + json[i].firstname + " " + json[i].lastname + "</p>";
							html +="</li>";
						}
					break;
				}

			}
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
		},
		error: function ()
		{
			//alert("error");
		}
	});

}
/******************************************************************
 *	分享文件 shareOperations()
 *	@param [sData]		data 
 *	@param [sType]		操作类别   [ shareDirectory : 分享文件夹 | shareFile : 分享文件 ]
 *  @param [operationsUrl]	操作链接
 *	@param [obj]		操作对象列表 [ html : 需要加入的字符串 | box : 字符串容器 | hidden : 数据容器 | remove : 需要隐藏或删除的容器 ] 
 *
 ******************************************************************/
function sendNewsfeed( data ){
	var strData = "";
	switch (data.type){
		case "share_file":
			strData = data;
		break;
		default :
		break;
	}
	$.ajax({
		type : "get",
		url : "/newsfeed/bizSendNewsfeed",
		data : strData,
		dataType : "json",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			//alert("js");
			//console.log(json);
			if(json.success){
				
			}else{
				//alert(json.error);
			}
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
		},
		error: function (json)
		{
			console.log(json);
			//alert(json.error);
		}
	});
}
/******************************************************************
 *	search user  getSearchUserList()
 *	@param [type]	 { name : 操作方式 | obj : 操作对象 | url : 操作链接 }
 *	@param [data]	{ str : 查询内容 | num : 返回个数 | userReady : 已存在的人员id => [1_2_3_] }
 *	@param [hidden]	{ obj : 隐藏域ID | other : 其他隐藏域 }
 *	@param [obj]	{ list : 操作显示list }
 ******************************************************************/
 //function getSearchUserList(type, str, num, userReady, operationsUrl, oList, hidden, obj){
function getSearchUserList(type, data, hidden, obj){
	var html = "";
	var oWrap = obj.list.prevAll(".addPeopleShow");
	//alert(type.name);
	
	//obj.list.empty();
	if (data.str == ""){
		if(obj.list.is(":visible")) { obj.list.hide(); }
	}else{
		$.ajax({
			type : "get",
			url : "user/SearchPeople",
			data : { textSearch : data.str, str_hide : data.userReady, limit : data.num},
			dataType : "json",
			cache : true,
			beforSend : function(XMLHttpRequest){
			},
			success : function (json){
				if (json != null){
					for ( var i = 0; i < json.length; i++){
						html +="<li class=\"quickLi\" name=\"" + json[i].firstname + " " + json[i].lastname + "\" nameID=\"" + json[i].user_id + "\">";
						html +="<img src=\"" + json[i].avatar + "\" class=\"userPhoto fl\" alt=\"\" />";
						html +="<p class=\"userName fl\">" + json[i].firstname + " " + json[i].lastname + "</p>";
						html +="</li>";
					}
				}
				if (html !=""){
					if(obj.list.is(":hidden")) { 
						obj.list.show();
						$("#hiddenCancel").data("close", "false");
					}
					obj.list.empty().append(html);
					//userList 点击补全信息
					switch(type.name){
						case "fileShare":
							obj.list.children("li").click(function(){
								html = "<li class=\"name\"><img src=\"" + $(this).children("img").attr("src") + "\" alt=\"" + $(this).attr("name") + "\" /><a href=\"#\" class=\"deleteName\" title=\"delete " + $(this).attr("name") + "\" nameID=\"" + $(this).attr("nameID") + "\"></a></li>";
								//$(html).insertAfter("#addShare");		
								hidden.obj.val(hidden.obj.val() + $(this).attr("nameID") + "_");
								hidden.other.val(hidden.other.val() + $(this).attr("nameID") + "_");
								obj.list.hide().empty();
								type.obj.find(".addPeopleText").val("");
								shareOperations({uid : type.uid, users : hidden.other.val(), fid : $("#hiddenFile").val()}, "shareFile", type.url, {html: html, box : $("ul.sharePeopleList"), remove : type.obj });
								//oText.val( $(this).attr("name") ).focus();
							});
						break;
						case "directoryShare":
							
							obj.list.children("li").click(function(e){
								e.stopPropagation();
								e.preventDefault();
								html = "<li class=\"name\"><img src=\"" + $(this).children("img").attr("src") + "\" alt=\"" + $(this).attr("name") + "\" /><a href=\"#\" class=\"deleteName\" title=\"delete " + $(this).attr("name") + "\" nameID=\"" + $(this).attr("nameID") + "\"></a></li>";
								//$(html).insertBefore(type.obj.find(".textLi"));		
								hidden.obj.val(hidden.obj.val() + $(this).attr("nameID") + "_");
								hidden.other.val(hidden.other.val() + $(this).attr("nameID") + "_");
								obj.list.hide().empty();
								type.obj.find(".addPeopleText").val("").focus();
								shareOperations({uid : type.uid, users : hidden.other.val(), did : $("#hiddenDirectory").val()}, "shareDirectory", type.url, {html: html, box : type.obj.find(".textLi"), remove : obj.list });
							});
						break;
						case "shareItemsFile":
							
							obj.list.children("li").click(function(e){
								e.stopPropagation();
								e.preventDefault();
								html = "<li class=\"name\"><img src=\"" + $(this).children("img").attr("src") + "\" alt=\"" + $(this).attr("name") + "\" /><a href=\"#\" class=\"deleteName\" title=\"delete " + $(this).attr("name") + "\" nameID=\"" + $(this).attr("nameID") + "\"></a></li>";
								//$(html).insertBefore(type.obj.find(".textLi"));		
								hidden.obj.val(hidden.obj.val() + $(this).attr("nameID") + "_");
								hidden.other.val(hidden.other.val() + $(this).attr("nameID") + "_");
								obj.list.hide().empty();
								type.obj.find(".addPeopleText").val("").focus();
								shareOperations({uid : type.uid, users : hidden.other.val(), fid : $("#hiddenFile").val()}, "shareItemsFile", type.url, {html: html, box : type.obj.find(".textLi"), remove : obj.list });
							});
						break;
						case "itemsShare":
							obj.list.children("li").click(function(){
								html = "<li class=\"name\"><img src=\"" + $(this).children("img").attr("src") + "\" alt=\"" + $(this).attr("name") + "\" /><a href=\"#\" class=\"deleteName\" title=\"delete " + $(this).attr("name") + "\" nameID=\"" + $(this).attr("nameID") + "\"></a></li>";
								//$(html).insertBefore(type.obj.find(".textLi"));		
								hidden.obj.val(hidden.obj.val() + $(this).attr("nameID") + "_");
								hidden.other.val(hidden.other.val() + $(this).attr("nameID") + "_");
								$(html).insertBefore(type.obj.find(".textLi"));	
								obj.list.hide().empty();
								type.obj.find(".addPeopleText").val("").focus();
								//删除已选中user列表中的user
								type.obj.find(".deleteName").click(function(e){
									e.preventDefault();		
									var sharePeople = hidden.other.val().replace(($(this).attr("nameID") + "_"),"");
									var allPeople = hidden.obj.val().replace(($(this).attr("nameID") + "_"),"");
									hidden.other.val(sharePeople);
									hidden.obj.val(allPeople);
									$(this).parent("li.name").remove();
								});
							});
						break;
						default:
							obj.list.children("li").click(function(){
								html = "<li class=\"namePic\"><img src=\"" + $(this).children("img").attr("src") + "\" alt=\"" + $(this).attr("name") + "\" /><a href=\"#\" class=\"deleteName\" title=\"delete " + $(this).attr("name") + "\" nameID=\"" + $(this).attr("nameID") + "\"></a></li>";
								$(html).insertAfter(oTextLi);		
								hidden.val(hidden.val() + $(this).attr("nameID") + "_");
								obj.list.hide();
								oText.val("").focus();
								$(".namePic").hover(function(){
									$(this).css("z-index" , "10");
									$(this).children(".deleteName").show();
								},function(){
									$(this).removeAttr("style");
									$(this).children(".deleteName").hide();
								});
								//删除已选中user列表中的user
								$(".deleteName").click(function(e){
									e.preventDefault();		
									var nameID = hidden.val().replace(($(this).attr("nameID") + "_"),"");
									hidden.val(nameID);
									$(this).parent("li.namePic").remove();
								});
							});
						break;
					}
				}else{
					if(obj.list.is(":visible")) { obj.list.hide(); }
				}
			},
			complete: function (XMLHttpRequest, textStatus)
			{
				//HideLoading();
			},
			error: function ()
			{
				//alert("error");
			}
		});
	}
}
$(document).ready(function() {
	if($.browser.webkit){
		
		//$("body").atomPop({
		//	headerText : "友情提示 ?",
		//	content : "请使用webkit内核浏览器（360浏览器除外）或者firefox，opera等浏览器浏览本网站，以便获得更好的体验 ?",
		//	done : function(){
		//		window.location.href = "http://www.atombeta.com";
		//	}
		//});
	}
	else if ($.browser.safari){}
	else if ($.browser.mozilla){}
	else if ($.browser.opera){}
	else{window.location.href = "/downBrowser.html";}
	document.onkeydown = function(event) {
		event = event || window.event;
		//IE suckes
		if(event.keyCode == 65 && event.ctrlKey) {
			//alert(event.keyCode);
			return false;
			event.preventDefault;
		}
		if(event.keyCode == 27) {
			event.preventDefault;
			if($(".notPopWindow").is(":hidden") && $(".popWindow").is(":visible")){
				$(".popWindow").find(".closePopIcon").click();
			}
			if($(".notPopWindow").is(":visible")){
				$(".notPopWindow").hide();
			}
		}
	}
	$("#commonAccount").find(".settings").click(function(e){
		e.preventDefault();
		if(!$('#settingsPop').length)
		{
			commonHeaderAjax('settingsPop','get','/CommonHeader/SettingsPop','');
		}
		else
		{
			$("#settingsPop").atomFly({ type : "fadeIn"});
		}
	});
	$(".closePopIcon").live("click", function(){
		$(this).parent(".commonPop").atomFly({ type : "fadeOut"});
	});
	$(".commonPop").find(".cancel").live("click", function(){
		$(this).closest(".commonPop").atomFly({ type : "fadeOut"});
	});
	$("#commonAccount").find(".signOut").click(function(e){
		e.preventDefault();
		commonHeaderAjax('signOut','get','/CommonHeader/signOut','');
	});
});



/*  2011-12-07 综合项目部分        版本1.0beta
 **  Atom  底层部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */

(function($) {
	$.fn.extend({
		/*
		 **  打开文件夹 左上角缩小在放大
		 **	 $("li.Folder").FileZoomIn({callBack:function(){}});
		 */
		//"FileZoomIn": function(options){
//			options = $.extend({
//				Box : "", //操作的元素
//				callBack : null //回调函数
//			}, options);
//			return this.live("dblclick", function(){
//				var oThis = $(this);
//				var oBox = options.Box;
//				var Range = {left : 0 , top : 0};
//				获取文件夹元素位置
//				Range.left = oThis.position().left;
//				Range.top = oThis.position().top;
//				子文件元素缩小至左上角
//				oThis.siblings("li").animate({left:0, top:0, width:0, height:0},function(){
//						$(this).remove();
//				});
//				oThis.remove();;
//				alert(oThis.siblings("li").length);
//				插入打开的文件夹显示的元素
//				$(".FolderShow").remove();
//				$("<div class='FolderShow'></div>").appendTo(oBox);
//				文件夹元素位移到预定位置
//				$(".FolderShow").css({margin:0, position: "absolute", left : Range.left, top : Range.top}).animate({
//					left: "-150px",
//					top :"65px"		
//				},function(){
//					回调
//					if ($.isFunction(options.callBack)) {
//						options.callBack();
//					}
//				});
//			});
//		},
		/*
		 **  打开文件夹
		 **	 $("li.Folder").FileZoomIn({callBack:function(){}});
		 */
		//"FileZoomIn": function(options){
//			options = $.extend({
//				Box : "", //操作的元素
//				Folder : "FolderBox", //操作的文件夹元素
//				callBack : null //回调函数
//			}, options);
//			return this.each(function(){
//				var oThis = $(this);
//				var oBox = options.Box;
//				var eFolder = options.Folder;
//				var nLength = oThis.children("li").length;
//				//alert(nLength);
//				oThis.children("li.Folder").click(function(event){
//					event.stopPropagation();
//					event.preventDefault();
//					var oFolder = $(this);
//					if($(".FolderBox").is(":visible")){
//						return false;
//					}
//					var nIndex = $(this).index();
//					//alert(nIndex);
//					var n;
//					
//					n = 3 - nIndex%4;
//					var hMask = $("<div>",{
//						id:"fileMask",
//						width: "960px",
//						height: $("ul.fileList").outerHeight(true)	+ 200
//					});
//					hMask.appendTo("#fileMain");
//					//alert(n);
//					oFolder.css({position:"relative", zIndex : "10"});
//					$("<li class=\"FolderBox FolderBox"+ nIndex%4 +"\"><ul class=\"fileSubList\"></ul></li>").insertAfter(oThis.children("li").eq(nIndex + n)).slideDown("fast",function(){
//						getFile(oFolder.attr("folderid"), ".fileSubList", false);
//					});
//					$(".FolderBox").click(function(event){
//						event.stopPropagation();
//						event.preventDefault();
//					});
//					$(document).click(function(){
//						//alert("js-ok");
//						if($(".FolderBox").is(":visible")){
//							$(".FolderBox").slideUp("fast",function(){
//								$(this).remove();
//								getFile("1", "ul.fileList", true);
//							});
//							hMask.remove();
//							$("li.Folder").removeAttr("style");
//							//$("#fileMain>ul").FileMove();
//						}
//					});
//				});
//			});
//		},
		/*
		 **  元素拖拽（触发替换位置与合并）-应用于文件模块
		 **	 $("li.dragBox").FileMove({callBack:function(){}});
		 */
		"FileMove": function(options){
			options = $.extend({
				Box : "#fileMain", //操作的区域元素
				Div : ".dragBox", //操作的元素
				Folder :"Folder", //文件夹元素
				Type : "full", //操作方式[full: 完全适用于文件根目录 | Folder: 只用于文件夹里的文件]
				callBack : null //回调函数
			}, options);
			return this.each(function(){
				//alert("js-ok");
				var oThis = $(this);
				var oDiv = oThis.children(options.Div);
				var oBox = $(options.Box);
				var eType = options.Type;
				var oInlineBlock;
				//元素属性[ w : 操作元素位移时的宽 | h : 操作元素位移时的高 | inlineW : 未移动元素的宽 | inlineH : 未移动元素的高 | inlineHW : 未移动元素半宽 | inlineHH : 未移动元素半高 ]
				var attribute = { w : 0, h : 0, inlineW : 0, inilneH : 0, inlineHW : 0, inlineHH : 0 };
				//元素偏移量[ x : 原始x偏移值 | y : 原始y偏移值 | moveX : 选中元素的left值 | moveY : 选中元素的top值  ]
				var range = { x : 0, y : 0, moveX : 0 , moveY : 0 };
				//元素位置[ x : 原始left值 | y : 原始top值 | inlineX : 未移动元素的left值 | inlineY : 未移动元素的top值 ]
				var position = { x : 0, y : 0, inlineX : 0, inlineY :0 };
				var aBlock = new Array();
				var bMove = bTrigger = false;
				var oShow;
				var sUrl = sData = "";
				var nLength = oThis.children("li").length;
				$(".fileUploadBox").click(function(){
					//alert("js-ok");
					//alert($(this).children("#theframe").length());
					var nID = $(this).attr("alt"); 
					//alert($("#" + oFrame).length);
					$("#theframe" + nID).contents().find("#progress_key").attr("value", nID);
					$("#theframe" + nID).contents().find(".fileUpload").click();
				});
				//关闭Upload窗口
				$("#CloseuploadDocument").directionExit({ ShowBox:".uploadDocument", Direction:"bottom",
					fun:function(){
						alert("js-ok");
						getFile("1", "ul.fileList", true);
					}
				});
				switch (eType){
					case "full" :
						oThis.children("li").on("dblclick", function(event){
							event.stopPropagation();
							event.preventDefault();
							var oFolder = $(this);
							nLength = oThis.children("li").length;
							//alert("123");
							if( oFolder.hasClass("noMoveBox") || oFolder.hasClass("dragBox") || $(".FolderBox").is(":visible")){ return false; }
							var nIndex = $(this).index();
							var n = 0;
							n = 3 - nIndex%4;
							var hMask = $("<div>",{
								id:"fileMask",
								width: "960px",
								height: $("ul.fileList").outerHeight(true)	+ 200
							});
							hMask.appendTo("#fileMain");
							oFolder.css({position:"relative", zIndex : "10"});
							$("<li class=\"FolderBox FolderBox"+ nIndex%4 +"\"><ul class=\"fileSubList\"></ul></li>").insertAfter(oThis.children("li").eq(nIndex + n >=  nLength ? nLength -1 : nIndex + n)).slideDown("fast",function(){
								getFile("1", oFolder.attr("folderid"), ".fileSubList", false);
							});
							$(".FolderBox").click(function(event){
								event.stopPropagation();
								event.preventDefault();
							});
							$(document).click(function(){
								if($(".FolderBox").is(":visible")){
									$(".FolderBox").slideUp("fast",function(){
										$(this).remove();
										getFile("1","1", "ul.fileList", true);
									});
									hMask.remove();
									$("li.Folder").removeAttr("style");
								}
							});
						});
						updataPosition();
					break;
					default :
					break;
				}
				oDiv.mousedown(function(event){
					event.stopPropagation();
					event.preventDefault();
					attribute.w = attribute.inlineW = oDiv.outerWidth();
					attribute.h = oDiv.children("section").outerHeight();
					attribute.inilneH = oDiv.outerHeight();
					attribute.inlineHW = attribute.inlineW/2;
					attribute.inlineHH = attribute.inilneH/2;
					var oMove = $(this);
					if( oMove.hasClass("noMoveBox") || oMove.hasClass(options.Folder)){ return false; }
					position.x = oMove.position().left;
					position.y = oMove.position().top;
					range.x = event.pageX - position.x;
					range.y = event.pageY - position.y;
					bMove = true;
					oMove.css({ left : position.x, top : position.y, width : attribute.w, height : attribute.h, zIndex : "10"}).attr("class", "moveBlock").siblings("li").addClass("inlineBlock");
					$("<li class=\"siteBlock\"></li>").insertBefore(oMove);
					//添加元素位移事件
					$(document).mousemove(function(eventMove){
						if(!bMove) { return false ; }
						range.moveX = eventMove.pageX - range.x;
						range.moveY = eventMove.pageY - range.y;
						oMove.css({left : range.moveX, top : range.moveY});
						switch (eType){
							case "full" :
								bTrigger = returnCollision(aBlock, range.moveX, range.moveY);
								if(bTrigger && oShow.hasClass("inlineBlock")){ oShow.addClass("FolderDash"); }
								else { oShow.removeClass("FolderDash"); }
							break;
							case "Folder":
								if(range.moveY < -210 || range.moveX > 910 || range.moveX < -230 || range.moveY > 390){ oMove.addClass("moveOut"); }
								else{ oMove.removeClass("moveOut"); }
							break; 
							default :
							break;
						}
						return false;
					});
				}).mouseup(function(event) {
					event.stopPropagation();
					event.preventDefault();
					oMove = $(this);
					if( oMove.attr("class") == options.Folder){ return false; }
					bMove = false;
					$(".siteBlock").remove();
					switch (eType){
						case "full" :
							if(oMove.siblings().hasClass("FolderDash")){
								var oTempDiv = $(".FolderDash");
								if (oTempDiv.hasClass("Folder")){
									sData = { fid : oMove.attr("fileID"), tpdid : oTempDiv.attr("folderID") };
									//移动文件
									fileOperations( sData, "moveFile", oMove, oTempDiv );
								}
								else if(oTempDiv.hasClass("dragBox")){
									sData = { fid_first : oMove.attr("fileID"), fid_second : oTempDiv.attr("fileID") };
									//合并文件
									fileOperations( sData, "combineFiles", oMove, oTempDiv );
								}
								else{}								
							}
							else{
								oMove.attr("class", "dragBox").removeAttr("style").siblings().removeClass("inlineBlock");
								oMove.children().show();
							}
						break;
						case "Folder":
							if (oMove.hasClass("moveOut")){
								fileOperations( { fid : oMove.attr("fileID"), tpdid : "1" }, "moveoutFile", oMove );
							}
							else{
								oMove.attr("class", "dragBox").removeAttr("style").siblings().removeClass("inlineBlock");
								oMove.children().show();
							}
						break; 
						default :
						break;
					}
                });
				oDiv.children("aside").mousedown(function(event){
					event.stopPropagation();	
				});
				oDiv.children("aside").children("label.fileNameInfo").click(function(event){
					event.stopPropagation();
					event.preventDefault();
					var oLabel = $(this);
					var oText = $(this).next("input.fileNameText");
					oLabel.hide();
					oText.show().val(oLabel.text()).focus();
				});
				oDiv.children("aside").children("input.fileNameText").blur(function(){
					$(this).hide();
					$(this).prev("label.fileNameInfo").show();
					if($(this).val() != ""){
						$(this).prev("label.fileNameInfo").text($(this).val());
						if ($(this).parent().parent().hasClass("Folder")){
							fileOperations({ did : $(this).parent().parent().attr("folderid"), name : $(this).val() }, "renameDirectory");						
						}else if ($(this).parent().parent().hasClass("dragBox")){
							fileOperations({ fid : $(this).parent().parent().attr("fileid"), name : $(this).val() }, "renameFile");	
						}
					}
				});
				oDiv.children("aside").children("input.fileNameText").keydown(function(e){
					var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
					if (keyCode == 13){ $(this).blur();}
				});
				oDiv.children("section").children(".Option").mousedown(function(event){
					event.stopPropagation();	
				});
				//点击显示简易菜单
				oDiv.children("section").children(".Option").click(function(){
					//alert("js-ok");
					event.stopPropagation();	
					$(this).children().show();
				});
				//删除文件
				$("li.fileDelete").on("click", function(){
					//alert("js-ok");
					var oDelBlock = $(this).parents("li.dragBox");
					//alert(oDelBlock.attr("fileID"));
					fileOperations( { fid : oDelBlock.attr("fileID")}, "removeFile", oDelBlock);
				});
				$(document).click(function(){
					$("div.Option").children().hide();
				});
				//返回是否触碰
				function returnCollision(a, left, top){
					var i = j =0;
					var bCollision = false;
					for ( i = 0; i < a.length ; i++){
						bCollision = left > a[i].left - attribute.inlineHW && left < a[i].left + attribute.inlineHW && top > a[i].top - attribute.inlineHH && top < a[i].top + attribute.inlineHH;
						if (bCollision ) {
							oShow = a[i].obj;
							break;
						}
					}
					return bCollision;
				}
				//初始化未移动元素位置
				function updataPosition(){
					aBlock = [];
					oThis.children().each(function(i) {
						aBlock.push($(this));
						aBlock[i] = { left : $(this).position().left, top : $(this).position().top, obj : $(this)};
					});
				}
				/******************************************************************
				 *	文件操作 fileOperations()
				 *	参数 [ sData : data | sType : 操作类别 | removeObj : 删除对象 | obj : 操作对象 ]
				 *	sType : [ moveFile : 移动文件到文件夹 | moveoutFile : 从文件夹里移出文件 | combineFiles : 合并文件 | removeFile : 删除文件 | renameFile : 文件重命名 | renameDirectory : 文件夹重命名]
				 *
				 ******************************************************************/
				function fileOperations( sData, sType, removeObj, obj ){
					switch (sType){
						case "moveFile":
							sUrl = "http://storage.atom.com/index.php?r=site/movefile";
						break;
						case "moveoutFile":
							sUrl = "http://storage.atom.com/index.php?r=site/movefile";
						break;
						case "combineFiles":
							sUrl = "http://storage.atom.com/index.php?r=site/combinefiles";
						break;
						case "removeFile":
							sUrl = "http://storage.atom.com/index.php?r=site/removefile";
						break;
						case "renameFile":
							sUrl = "http://storage.atom.com/index.php?r=site/renamefile";
						break;
						case "renameDirectory":
							sUrl = "http://storage.atom.com/index.php?r=site/renamedirectory";
						break;
						default :
						break;
					}
					$.ajax({
						type : "get",
						url : sUrl,
						data : sData,
						dataType : "jsonp",
						cache : true,
						beforSend : function(XMLHttpRequest){
						},
						success : function (json){
							$("#Alert").text(json.result);
							if(json.result == "success"){
								switch (sType){
									case "moveFile":
										removeObj.remove();	
										updataPosition();
										$("#Alert").text(obj.index());
										obj.attr("class","Folder").siblings().removeClass("inlineBlock");
										obj.children("aside").children("label.fileNameInfo").click();
									break;
									case "moveoutFile":
										removeObj.remove();	
										updataPosition();
									break;
									case "combineFiles":
										removeObj.remove();	
										updataPosition();
										obj.removeAttr("fileID").attr("folderID", json.did);
										obj.children("section").children("div.Option").remove();
										obj.children("aside").children("label.fileNameInfo").text(json.dname);
										obj.attr("class","Folder").siblings().removeClass("inlineBlock");
										obj.children("aside").children("label.fileNameInfo").click();
									break;
									case "removeFile":
										removeObj.remove();	
										updataPosition();
									break;
									default :
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
							switch (sType){
								case "moveFile":
									removeObj.attr("class", "dragBox").removeAttr("style").siblings().removeClass("inlineBlock");
									removeObj.children().show();
								break;
								case "moveoutFile":
									removeObj.attr("class", "dragBox").removeAttr("style").siblings().removeClass("inlineBlock");
									removeObj.children().show();
								break;
								case "combineFiles":
									removeObj.attr("class", "dragBox").removeAttr("style").siblings().removeClass("inlineBlock");
									removeObj.children().show();
								break;
								default :
								break;
							}
						}
					});
				}
			});
		}
		//new
	});
})(jQuery);

/**************************************************
 *	读取文件列表 getFile()
 *	参数 [ folderID : 文件夹ID | box : 容器 | b : 是否为根目录 ]
 *
 ***************************************************/
function getFile(user, folderID, box ,b){
	$.ajax({
		type : "get",
		url : "http://storage.atom.com/index.php?r=site/listdirectorycontent",
		data : "did="+folderID+"&uid=" + user + "&callback=?",
		dataType : "jsonp",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			//alert("js-ok");
			$(box).html("");
			var time = new Date();
			var nRandom = time.getTime().toString() +parseInt(Math.random()*100);
			//alert(nRandom);
			var htmlFile = "";
			if(b){
				htmlFile +="<li class=\"fileUploadBox noMoveBox\" alt=\"" + nRandom + "\" id=\"imgDropBox\">";
				htmlFile +="<iframe id=\"theframe" + nRandom + "\" name=\"theframe\" src=\"upload.php?id=" + nRandom + "\" class=\"fileUploadFrame\" >";
				htmlFile +="</iframe>";
				htmlFile +="</li>";
			}
			$.each(json.directories, function(index, data){
				htmlFile +="<li class=\"Folder\" folderID=\""+ data.storage_directory_id +"\">";
				htmlFile +="<section>";
				//htmlFile +="<ul><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>";
				htmlFile +="</section>";
				htmlFile +="<aside>";
				htmlFile +="<label for=\""+ data.storage_directory_id +"\" class=\"fileNameInfo\">"+ data.name +"</label>";
				htmlFile +="<input type=\"text\" id=\""+ data.storage_directory_id +"\" class=\"fileNameText\" />";
				htmlFile +="<div class=\"fileDate\">December 30, 2011 11:19 AM</div>";
				htmlFile +="</aside>";
				htmlFile +="</li>";
			});
			$.each(json.files, function(index, data){
				htmlFile +="<li class=\"dragBox\" fileID=\""+ data.storage_file_index_id +"\">";
				htmlFile +="<section>";
				htmlFile +="<div class=\"Option\">";
				htmlFile +="<div class=\"easyMenu\"></div><ul>";
				htmlFile +="<li><a href=\"http://storage.atom.com/index.php?r=site/downloadFile&fid="+ data.storage_file_index_id +"&callback=?\">Download</a></li>";
				htmlFile +="<li>Share</li>";
				htmlFile +="<li>Comment</li>";
				htmlFile +="<li class=\"fileDelete\">Delete</li>";
				htmlFile +="</ul>";
				htmlFile +="</div>";
				htmlFile +="</section>";
				htmlFile +="<aside>";
				htmlFile +="<label for=\""+ data.storage_file_index_id +"\" class=\"fileNameInfo\">"+ data.file_name +"</label>";
				htmlFile +="<input type=\"text\" id=\""+ data.storage_file_index_id +"\" class=\"fileNameText\" />";
				htmlFile +="<div class=\"fileDate\">December 30, 2011 11:19 AM</div>";
				htmlFile +="</aside>";
				htmlFile +="</li>";
			});
			$(htmlFile).appendTo(box);
			if(b){
				$(box).FileMove();
			}
			else{
				$(box).FileMove({Type : "Folder"});
			}
			
			
//			function stopPrevent(e){
//				e.stopPropagation();
//				e.preventDefault();
//			}
			
			
//			var imgDropBox =  document.getElementById('imgDropBox');
//			imgDropBox.addEventListener("dragenter",stopPrevent, false);
//			imgDropBox.addEventListener("dragover", stopPrevent, false);
//			imgDropBox.addEventListener("drop", function(e){
//				e.stopPropagation();
//				e.preventDefault();
//				//alert("drop");
//				var fileReader = new FileReader();
//				var file =e.dataTransfer.files;
//				fileReader.readAsBinaryString(file[0]);
//				fileReader.onloadend = function(){
//					//alert(this.readyState);console.log(this.result); // (0,1,2 :)读取完成回调函数，数据保存在result中
//					//console.log(fileReader, file.fileName, file.FileSize);
//					//console.log(file);
//					//console.log(file.fileName);
//					//console.log(file.fileSize);
//					
//					console.log(fileReader, file[0].fileName, file[0].fileSize);
//					console.log(file[0]);
//					//console.log(this.result);
//					console.log(fileReader);
//					
//				}
//





//			}, false);
//			  $('#file_upload').uploadify({
//				'uploader'  : 'http://xuchen.atom.com/xuchen/images/uploadify.swf',
//				'script'    : 'http://xuchen.atom.com/xuchen/uploadify.php',
//				'cancelImg' : 'http://xuchen.atom.com/xuchen/images/cancel.png',
//				'folder'    : '/xuchen/uploads',
//				'queueID' : 'uploadDocument',
//				'width' : '170',
//				'height' : '278',
//				'sizeLimit'	: 840000,
//				'hideButton': true,
//				'wmode' : 'transparent',
//				'multi'	 : true,
//				'auto'      : true
//			  });
			  //dropFileUp();
			//$(box + " aside").inputChange({ Label : ".fileNameInfo", Text : ".fileNameText" });
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
			
		},
		error: function ()
		{
			//请求出错处理
		}
	});
}

/**************************************************************
 *	Common isVisible(parent, child) 	计算子类是否被父类overflow:hidden影响 
 *	parent : $(sleector)		父类
 *	child : $(sleector)		子类 
 **************************************************************/
function isVisible(parent, child){
	var isShow = true;
	var attribute = { pl : parent.offset().left, pw : parent.outerWidth(), cl : child.offset().left};
	var postion = { pl : attribute.pl, pr : attribute.pl + attribute.pw, cl : attribute.cl};
//	alert(postion.cl);
//	alert(postion.pr);
	if (postion.cl <= postion.pl || postion.cl >= postion.pr) { isShow = false; }
	return isShow;
}

/**************************************************
 *	IM IMPosition(b) 	输出IM模块位置 
 *	b : [ true | false ]	按钮是否输出
 ***************************************************/
function IMPosition(b){
	var oBtnL = $("#imTurnLeft");
	var oBtnR = $("#imTurnRight");
	var oBox = $("#imMessageBox");
	var position = { BtnL : 0, BtnR : 0, Box : 0};
	var width = { win : $(window).outerWidth(true), btn : 30, other : 185, box : 0};
	var nLength = 0;
	width.box = width.win - 2* width.btn - width.other - 5;
	nLength = parseInt(width.box / 267);
	width.box = 267 *  nLength;
	position.Box = width.other + width.btn + 5;
	position.BtnL = width.box + width.other + width.btn +10;
	if(b){
		oBox.css({ "width" : width.box + "px", "right" : position.Box + "px"});
		oBtnR.css({"right" : width.other + "px"});
		oBtnL.css({"right" : position.BtnL + "px"});
	}else{
		oBox.css({ "width" : width.box + "px", "right" : width.other + "px"});
		oBtnR.hide();
		oBtnL.hide();
	}
}
/********************************************************
 *	IM IMLength() 	返回IM模块在当前屏幕下最多可以是显示几个窗口  
 ********************************************************/
function IMLength(){
	var width = { win : $(window).outerWidth(true), btn : 30, other : 185, box : 0};
	var nLength = 0;
	width.box = width.win - 2* width.btn - width.other - 5;
	nLength = parseInt(width.box / 267);
	return nLength;
}
/********************************************************
 *	IM IMShow() 	初始化聊天窗口队列属性show 判断是否显示  
 ********************************************************/
function IMShow(){
	var oBox = $("#imMessageList");
	var oBlock = $("#imMessageList").children();
	var bShow= false;
	oBlock.each(function(index, element) {
		bShow = isVisible($("#imMessageBox"), $(this));
        $(this).attr("show", bShow);
		//对应的显示窗口更新show属性
		$("#"+$(this).attr("alt")).attr("show", bShow);
    });
}
/********************************************************
 *	IM IMBtn() 	初始化左右移动按钮  
 ********************************************************/
function IMBtn(){
	var oTurnL = $("#imTurnLeft");
	var oTurnR = $("#imTurnRight");
	var oBoxList = $("#imMessageList");
	var oBox = oBoxList.children();
	var oShowBox = oBoxList.children("[show=true]");
	var nMax = IMLength();
	if (oBoxList.children().length > nMax) {
		if (oShowBox.last().nextAll().length>0) {oTurnL.show();}
		else { oTurnL.hide(); }
		if (oShowBox.first().prevAll().length>0) {oTurnR.show();}
		else { oTurnR.hide(); }
	}else{
		oTurnL.hide();
		oTurnR.hide();
	}
}
/********************************************************
 *	IM IMMove() 	IM窗口移动  
 * obj 操作对象
 ********************************************************/
function IMMove(obj){
	//alert("js-ok");
	var nMax = IMLength();
	var nPrevLength = obj.prevAll().length;
	var nNextLength = obj.nextAll().length;
	var oPrevShow = obj.prevAll("[show=true]");
	var oNexShow = obj.nextAll("[show=true]");
	var nPrevShow = oPrevShow.length;
	var nNexShow = oNexShow.length;
	var n = i = 0;
	//alert("js-ok-0"); 
	$(".imMessageBlock[alt=win]:visible").not("#"+obj.attr("alt")).find(".on").click();
	if(obj.attr("show") != "true"){
		
		if(nPrevShow > 0){
			//alert("js-ok");
			n = obj.prevUntil("[show=true]").length+1; // 移动次数
			if(!$("#imMessageList").is(":animated")){
				$("#imMessageList").animate({right: "-=" + 267 * n},function(){
					IMShow();
					IMBtn();
					obj.find(".off").click();
				});
			}
		}
		if(nNexShow > 0){
			//alert("js-ok");
			n = obj.nextUntil("[show=true]").length +1; // 移动次数
			if(!$("#imMessageList").is(":animated")){
				$("#imMessageList").animate({right: "+=" + 267 * n},function(){
					IMShow();
					IMBtn();
					obj.find(".off").click();
				});
			}
		}
	}else {
		obj.find(".off").click();
	}
	
	
}





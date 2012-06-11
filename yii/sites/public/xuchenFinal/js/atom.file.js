/*  2012-02-19 file        版本1.0beta
 **  Atom  file页面底层部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */

(function($) {
	$.fn.extend({
		/******************************************************************
		 *	atom file system obj.atomFile()
		 *  @param [data]	[ uid : user id, did : file id, url : storage url ]
		 *	@param [type]	[ full : all files | directory : file directory | share : share directory ]
		 * 	@param [isDrag]	is drag drop [ true | false ]	
		 *	@param [box]	file wrap class	
		 *	@param [directory]	directory class	
		 *	@param [callback]	callback function
		 ******************************************************************/
		"atomFile": function(options){
			options = $.extend({
				data : { uid : "", did : "", url : ""},
				type : "full",
				isDrag : true,
				box : "#fileMain",
				directory :"folder",
				callBack : null
			}, options);
			return this.each(function(){
				//alert("js-ok");
				//console.log(options.data.uid, options.data.did, options.data.url);
				var $this = $(this);
				var $div = $this.children("li[bind=off]");
				var $drag = $this.children("li[bind=off][drag=true]");
				var $box = $(options.box);
				var $hidden = { file : $("#hiddenFile"), directory : $("#hiddenDirectory"), position : $("#hiddenPosition")};
				//元素属性[ w : 操作元素位移时的宽 | h : 操作元素位移时的高 | inlineW : 未移动元素的宽 | inlineH : 未移动元素的高 | inlineHW : 未移动元素半宽 | inlineHH : 未移动元素半高 ]
				var attribute = { width : $div.width(), height : $div.children("section").height(), inlineW : 0, inilneH : 0, inlineHW : $div.width() / 2, inlineHH : $div.children("section").height() / 2 };
				//元素偏移量[ x : 原始x偏移值 | y : 原始y偏移值 | moveX : 选中元素的left值 | moveY : 选中元素的top值  ]
				var range = { x : 0, y : 0, moveX : 0 , moveY : 0 };
				//元素位置[ x : 原始left值 | y : 原始top值 | inlineX : 未移动元素的left值 | inlineY : 未移动元素的top值 ]
				var position = { x : 0, y : 0, inlineX : 0, inlineY :0 };
				//move return position
				var movePosition = { left : 0, top : 0 };
				var aBlock = new Array();
				var bMove = bTrigger = bDrop = false;
				var oShow;
				var sUrl = sData = "";
				var nCol = 0;
				//updata position
				//console.log(aBlock);
				$div.attr("bind", "on");
				//打开文件夹
				//$div.children("section").off("dblclick");
				$div.children("section").on("dblclick", function(event){
					//alert("js-ok");
					//event.stopPropagation();
					//event.preventDefault();
					var oFolder = $(this).parent();
					nLength = $this.children("li").length;
					//alert(nLength);
					//if( oFolder.attr("drag") == "true" || !oFolder.hasClass("folder") || $(".folderBox").is(":visible")){ return false; }
					if (oFolder.hasClass("folder")){
						var nIndex = oFolder.index();
						//alert(nIndex);
						var n = 0;
						nCol = parseInt($box.width() / 157);
						n = nCol - 1 - nIndex % nCol;
						//alert(n);
						var hMask = $("<div>", {
							width: $(window).width(),
							height: $(document).height(),
							id: "fileMask"
						});
						$("body").css({position: "relative"}).append(hMask);
						$("#fileMask").fadeIn();
						oFolder.css({position:"relative", zIndex : "10"});
						$("<li class=\"folderBox folderBox"+ nIndex % nCol +"\" folderid=\"" + oFolder.attr("folderid") + "\"><ul class=\"fileSubList\"></ul></li>").insertAfter($div.eq(nIndex + n >=  nLength ? nLength -1 : nIndex + n)).slideDown("fast",function(){
							$hidden.directory.val(oFolder.attr("folderid"));
							getFileList({uid : options.data.uid, did : $hidden.directory.val(), url : options.data.url}, "directory", {box : $(".fileSubList")}, true );
						});
						$(".folderBox").click(function(event){
							event.stopPropagation();
							event.preventDefault();
						});
						$("#fileMask").click(function(){
							if($(".folderBox").is(":visible")){
								$(".folderBox").slideUp("fast",function(){
									$(this).remove();
									emptyHidden([$hidden.directory]);
									//getFileUpdates();
									//getFileList({ uid : options.data.uid, did : "", url : options.data.url}, "allFiles", { box : $("#fileMain ul.fileList")}, true );
								});
								$("#fileMask").remove();
								$("li.folder").removeAttr("style");
							}
						});
					}else{
						if($("#fileInformation").is(":hidden")){
							$hidden.file.val(oFolder.attr("fileid"));
							getFile($hidden.file.val(), "#fileInformation", options.data.url)
							$("#fileInformation").atomFly({type: "fadeIn"});
						}
					}
					
				});
				switch (options.type){
					case "directory":
						//share directory
						$(".folderTitle").children(".share").on("click", function(){
							$("#shareBox").atomFly({type: "fadeIn"});
							getShareList({did : $hidden.directory.val()}, options.data.url, "directoryList", { box : $("#shareBox") });
						});
						$("#shareBox").find(".shareFile").off("click");
						$("#shareBox").find(".shareFile").on("click", function(event){
							$("#closeShareBox").click();
						});
						$("#closeShareBox").off("click");
						$("#closeShareBox").on("click", function(){
							var closeBtn = $(this);
							$("#shareBox").atomFly({
								type : "fadeOut",
								callBack : function(){
									//alert("js-ok");
									var oPeopleList = closeBtn.next().next(".addPeopleBlock");
									oPeopleList.children(".addPeopleShow").children().not(".textLi").remove();
									oPeopleList.children(".addPeopleShow").children(".textLi").children(".addPeopleText").val("");
									oPeopleList.children(".hiddenPeople").val("");
									oPeopleList.children(".hiddenShare").val("");
								}
							});
						});
					break;
					default :
					break;
				}
				//close file information
				$("#closeFileInformation").off("click");
				$("#closeFileInformation").on("click" ,function(){
					$("#fileInformation").atomFly({ 
						type : "fadeOut" ,
						callBack : function(){
							emptyHidden([$hidden.file]);
						}
					});
				});
				$div.on("click", function(event){
					event.stopPropagation();
					//event.preventDefault();
					if($(this).hasClass("folder")){$(this).addClass("selected");}
				});
				//darg drop is true
				//if (options.isDrag){
//					//$this.children("li[drag=true]").off("mousedown"
//					//$div.on("mousedown", function(e){
//					$drag.on("mousedown", function(e){
//						e.preventDefault();
//						var $move = $(this);
//						if (!$move.is(":animated")){
//							position.x = movePosition.left = $move.position().left;
//							position.y = movePosition.top = $move.position().top;
//							range.x = e.pageX - position.x;
//							range.y = e.pageY - position.y;
//							$move.clone().attr("drag", "flase").addClass("siteBlock").insertBefore($move);
//							$move.css({ "left" : position.x, "top" : position.y, "height" : attribute.height, "zIndex" : 10}).addClass("moveBlock").siblings("li").addClass("inlineBlock");
//							//bind $move move funciton
//							$(document).mousemove(function(eMove){
//								range.moveX = eMove.pageX - range.x;
//								range.moveY = eMove.pageY - range.y;
//								$move.css({left : range.moveX, top : range.moveY});
//								switch (options.type){
//									case "full":
//										bTrigger = isContact($("#hiddenPosition").data("position"), range.moveX, range.moveY);
//										if(bTrigger.contact && bTrigger.obj.hasClass("inlineBlock")){ bTrigger.obj.addClass("folderDash"); }
//										else { $div.removeClass("folderDash"); }
//									break;
//									case "directory":
//										var inBox = isVisible($(".folderBox"), $move);
//										if(!inBox){ $move.addClass("moveOut"); }
//										else{ $move.removeClass("moveOut"); }
//									break;
//									default:
//									break;
//								}
//							});
//							//bind #move move finish function
//							$(document).on("mouseup", function(eUp){
//								//alert($move.position().top);
//								$(document).off("mousemove");
//								if(e.pageX == eUp.pageX && e.pageY == eUp.pageY){
//									//alert(1);
//									$(".siteBlock").remove();
//									$move.removeClass("moveBlock").addClass("selected").removeAttr("style").siblings().removeClass("inlineBlock");
//								}else{
//									$move.removeClass("selected");
//									switch (options.type){
//										case "full" :
//											if($(".folderDash").length == 1 ){
//												var oTempDiv = $(".folderDash");
//												if (oTempDiv.attr("drag") != "true"){
//													//sData = { fid : oMove.attr("fileID"), tpdid : oTempDiv.attr("folderID") };
//													$(".siteBlock").remove();
//													//移动文件
//													fileOperations({uid : options.data.uid, fid : $move.attr("fileID"), tpdid : oTempDiv.attr("folderID")}, options.data.url, "moveFile", { remove : $move, temp : oTempDiv});
//												}
//												if(oTempDiv.attr("drag") == "true"){
//													//sData = {uid : options.uID, fid_first : oMove.attr("fileID"), fid_second : oTempDiv.attr("fileID") };
//													$(".siteBlock").remove();
//													//合并文件
//													fileOperations({uid : options.data.uid, fid_first : $move.attr("fileID"), fid_second : oTempDiv.attr("fileID")}, options.data.url, "combineFiles", { remove : $move, temp : oTempDiv});
//												}							
//											}
//											else{
//												$move.animate({
//													left : movePosition.left + "px",
//													top : movePosition.top + "px"
//												},"400", function(){
//													$(".siteBlock").remove();
//													$move.removeClass("moveBlock").removeAttr("style").siblings().removeClass("inlineBlock");
//												});
//												
//											}
//										break;
//										case "directory":
//											if ($move.hasClass("moveOut")){
//												//move file out to directory
//												$(".siteBlock").remove();
//												fileOperations( {uid : options.data.uid, fid : $move.attr("fileID"), tpdid : 0}, options.data.url, "moveoutFile", { remove : $move });
//											}
//											else{
//												$move.animate({
//													left : movePosition.left + "px",
//													top : movePosition.top + "px"
//												},"400", function(){
//													$(".siteBlock").remove();
//													$move.removeClass("moveBlock").removeAttr("style").siblings().removeClass("inlineBlock");
//												});
//											}
//										break; 
//										default :
//										break;
//									}
//								}
//								$(document).off("mouseup");
//							});
//						}
//					});
//				}
				//drag drop is flase
				//else {
//					$div.children("section").on("click", function(event){
//						event.stopPropagation();
//						event.preventDefault();
//						var oFolder = $(this).parent();
//						oFolder.addClass("selected");
//					});
//				}
				//rename
				$div.children("aside").mousedown(function(event){
					event.stopPropagation();	
				});
				$div.children("aside").children("label.fileNameInfo").click(function(event){
					event.stopPropagation();
					var oLabel = $(this);
					var oText = $(this).next("input.fileNameText");
					oLabel.hide();
					oText.show().val(oLabel.text()).focus();
				});
				$div.children("aside").children("input.fileNameText").blur(function(){
					$(this).hide();
					$(this).prev("label.fileNameInfo").show();
					if($(this).val() != ""){
						$(this).prev("label.fileNameInfo").text($(this).val());
						if ($(this).parent().parent().hasClass("folder")){
							//directory rename
							fileOperations({ uid : options.data.uid, did : $(this).parent().parent().attr("folderid"), name : $(this).val()}, options.data.url, "renameDirectory", "" );						
						}
						if ($(this).parent().parent().attr("drag") == "true"){
							//file rename
							fileOperations({ uid : options.data.uid, fid : $(this).parent().parent().attr("fileid"), name : $(this).val()}, options.data.url, "renameFile", "" );	
						}
					}
				});
				$div.children("aside").children("input.fileNameText").keydown(function(e){
					var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
					if (keyCode == 13){ $(this).blur();}
				});
				//is contact function
				function isContact(a, left, top){
					var i = 0;
					var result = { contact : "", obj : ""};
					for ( i = 0; i < a.length ; i++){
						result.contact = left > a[i].left - attribute.inlineHW && left < a[i].left + attribute.inlineHW && top > a[i].top - attribute.inlineHH && top < a[i].top + attribute.inlineHH;
						if ( result.contact ) {
							result.obj = a[i].obj;
							break;
						}
					}
					return result;
				}
				
			});
		}
		//new
	});
})(jQuery);
//updata position function
function updataPosition(obj){
	var aBlock = [];
	obj.children().not("li.siteBlock").each(function(i) {
		aBlock[i] = { left : $(this).position().left, top : $(this).position().top, obj : $(this)};
	});
	$("#hiddenPosition").data("position", aBlock);
	//return aBlock;
}
/******************************************************************
 *	file operations
 *	@param data [ ajax data ]
 *	@param url [ ajax url ]
 *	@param type [ moveFile : 移动文件到文件夹 | moveoutFile : 从文件夹里移出文件 | combineFiles : 合并文件 | removeFile : 删除文件 | renameFile : 文件重命名 | renameDirectory : 文件夹重命名]
 *	@param obj [ operations obj ]
 ******************************************************************/
function fileOperations( data, url, type, obj ){
	var strUrl = strData = "";
	//console.log(data);
	switch (type){
		case "renameFile":
			strUrl = url + "index.php?r=file/renamefile";
			strData = data;
		break;
		case "renameDirectory":
			strUrl = url + "index.php?r=file/renamedirectory";
			strData = data;
		break;
		case "combineFiles":
			strUrl = url + "index.php?r=file/combinefiles";
			strData = data;
		break;
		case "moveFile":
			strUrl = url + "index.php?r=file/movefile";
			strData = data;
		break;
		case "moveoutFile":
			strUrl = url + "index.php?r=file/movefile";
			strData = data;
		break;
		case "removeFile":
			strUrl = url + "index.php?r=file/removefile";
			strData = data;
		break;
		case "addComment":
			strUrl = url + "index.php?r=file/addComment";
			strData = data;
		break;
		case "getComment":
			strUrl = url + "index.php?r=file/getComments";
			strData = data;
		break;
		default :
		break;
	}
	$.ajax({
		type : "get",
		url : strUrl,
		data : strData,
		dataType : "jsonp",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			console.log(json);
			if(json.success){
				switch (type){
					//combe files
					case "combineFiles":
						obj.remove.remove();	
						obj.temp.removeAttr("drag");
						obj.temp.removeAttr("fileID").attr("folderID", json.did);
						//obj.children("section").children("div.Option").remove();
						obj.temp.children("aside").children("label.fileNameInfo").text(json.dname);
						obj.temp.attr("class","folder").siblings().removeClass("inlineBlock");
						obj.temp.children("aside").children("label.fileNameInfo").click();
						obj.temp.children("section").click();
						updataPosition($("#fileList"));
					break;
					//move file in diretory
					case "moveFile":
						obj.remove.remove();	
						updataPosition($("#fileList"));
						obj.temp.attr("class","folder").siblings().removeClass("inlineBlock");
					break;
					case "moveoutFile":
					//console.log(removeObj.closest(".folderBox").prevAll().length % nCol);
						var nCol = parseInt($("#fileMain").width() / 157);
						if (obj.remove.closest(".folderBox").prevAll().length % nCol > 0){
							obj.remove.clone().attr("bind", "off").removeClass().removeAttr("style").insertBefore(obj.remove.closest(".folderBox"));	
						}else{
							obj.remove.clone().attr("bind", "off").removeClass().removeAttr("style").appendTo(".fileList");	
						}
						obj.remove.remove()
						updataPosition($("#fileList"));
						$("#fileList").atomFile({data : {uid : $("#hiddenUser").data("uid"), did : "", url : "/"}, type : "full" });
					break;
					case "removeFile":
						removeObj.remove();	
						updataPosition($("#fileList"));
					break;
					default :
					break;
				}
			}else{
				console.log(json.error);
				//alert(json.error);
			}
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
		},
		error: function (json)
		{
			//alert(json);
		}
	});
}
/**************************************************
 *	getFileList
 *	@param [data] data [ uid : user id | did : directory id ]
 *	@param [type] type
 *  @param [obj] obj
 *	@param [isDrag] is drag and drop
 ***************************************************/
function getFileList(data, type, obj, isDrag){
	var strData = strUrl = strBaseDirectory = strBaseFile = "";
	//console.log(data);
	switch (type){
		case "allFiles":
			strUrl = data.url + "index.php?r=file/listdirectorycontent";
			strData = { uid : data.uid, did : data.did};
		break;
		case "myFiles":
			strUrl = data.url + "index.php?r=file/GetMyFiles";
			strData = { uid : data.uid};
		break;
		case "directory":
			strUrl = data.url + "index.php?r=file/listdirectorycontent";
			strData = { uid : data.uid, did : data.did};
		break;
		case "sharingDirectory":
			strUrl = data.url + "index.php?r=file/GetSharedItems";
			strData = { uid1 : data.uid, uid2 : data.shareUsers};
		break;
		default:
		break;
	}
	$.ajax({
		type : "get",
		url : strUrl,
		data : strData,
		dataType : "jsonp",
		cache : true,
		beforeSend : function(XMLHttpRequest){
			//console.log(XMLHttpRequest.readyState);
			if(XMLHttpRequest.readyState == 0){
				obj.box.html("");
				obj.box.addClass("loadingFiles");
			}
		},
		success : function (json){
			obj.box.removeClass("loadingFiles");
			var htmlFile = "";
			switch(type){
				case "allFiles":
					if(json.directories != null){
						//globalFile = json.directories;
						//strBaseDirectory = JSON.stringify(json.directories);
						strBaseDirectory = json.directories;
						$.each(json.directories, function(index, data){
							//if(data.permissions == 5){htmlFile +="<li class=\"folder\" folderID=\""+ data.storage_directory_id +"\">";}
							//else{htmlFile +="<li class=\"folder share\" folderID=\""+ data.storage_directory_id +"\">";}
							htmlFile +="<li class=\"folder\" folderID=\""+ data.storage_directory_id +"\" bind=\"off\">";
							htmlFile +="<section>";
							htmlFile +="<span></span>";
							htmlFile +="</section>";
							htmlFile +="<aside>";
							htmlFile +="<label for=\""+ data.storage_directory_id +"\" class=\"fileNameInfo Rows\">"+ data.name +"</label>";
							htmlFile +="<input type=\"text\" id=\""+ data.storage_directory_id +"\" class=\"fileNameText\" />";
							//htmlFile +="<div class=\"fileDate\">"+ data.updated +"</div>";
							htmlFile +="</aside>";
							htmlFile +="</li>";
						});
					}
				break;
				case "directory":
					htmlFile +="<div class=\"folderTitle\" folderID =\"" + data.did + "\">" + json.name + " </div>";
					//htmlFile +="<div class=\"folderTitle\" folderID =\"" + data.did + "\">" + json.name + " <span class=\"share\">share list</span></div>";
				break;
				case "sharingDirectory":
					if(json.directories != null){
						//strBaseDirectory = JSON.stringify(json.directories);
						strBaseDirectory = json.directories;
						$.each(json.directories, function(index, data){
							//if(data.permissions == 5){htmlFile +="<li class=\"folder\" folderID=\""+ data.storage_directory_id +"\">";}
							//else{htmlFile +="<li class=\"folder share\" folderID=\""+ data.storage_directory_id +"\">";}
							htmlFile +="<li class=\"folder\" folderID=\""+ data.storage_directory_id +"\" bind=\"off\">";
							htmlFile +="<section>";
							htmlFile +="<span></span>";
							htmlFile +="</section>";
							htmlFile +="<aside>";
							htmlFile +="<label for=\""+ data.storage_directory_id +"\" class=\"fileNameInfo Rows\">"+ data.name +"</label>";
							htmlFile +="<input type=\"text\" id=\""+ data.storage_directory_id +"\" class=\"fileNameText\" />";
							//htmlFile +="<div class=\"fileDate\">"+ data.updated +"</div>";
							htmlFile +="</aside>";
							htmlFile +="</li>";
						});
					}
				break;
				default:
				break;
			}
			if(json.files != null){
				//strBaseFile = JSON.stringify(json.files);
				strBaseFile = json.files;
				$.each(json.files, function(index, data){
					htmlFile +="<li drag=\"true\" fileID=\""+ data.storage_file_index_id +"\" bind=\"off\" draggable=\"true\">";
					htmlFile +="<section>";
					htmlFile +="<span></span>";
					htmlFile +="</section>";
					htmlFile +="<aside>";
					htmlFile +="<label for=\""+ data.storage_file_index_id +"\" class=\"fileNameInfo Rows\">"+ data.file_name +"</label>";
					htmlFile +="<input type=\"text\" id=\""+ data.storage_file_index_id +"\" class=\"fileNameText\" />";
					//htmlFile +="<div class=\"fileDate\">"+ data.updated +"</div>";
					htmlFile +="</aside>";
					htmlFile +="</li>";
				});
			}
			$(htmlFile).appendTo(obj.box);
			switch(type){
				case "allFiles":
					$("#hiddenBaseDirectory").data("directory", strBaseDirectory).val(JSON.stringify(strBaseDirectory));
					$("#hiddenBaseFile").data("file", strBaseFile).val(JSON.stringify(strBaseFile));
					//console.log($("#hiddenBaseDirectory").data("directory"));
					//console.log(strBaseFile["76"]);
					
					//console.log($("#hiddenBaseFile").data("file"));
					
					updataPosition($("#fileList"));
					//console.log($("#hiddenPosition").data("position"));
					getFileUpdates();
					obj.box.atomFile({data : {uid : data.uid, did : data.did, url : data.url}, type : "full" });
				break;
				case "myFiles":
					obj.box.atomFile({data : {uid : data.uid, did : data.did, url : data.url}, type : "full", isDrag : false});
				break;
				case "directory":
					if(isDrag){obj.box.atomFile({data : {uid : data.uid, did : data.did, url : data.url}, type : "directory"});}
					else{obj.box.atomFile({data : {uid : data.uid, did : data.did, url : data.url}, type : "directory", isDrag : false});}					
				break;
				case "sharingDirectory":
					obj.box.atomFile({data : {uid : data.uid, did : data.did, url : data.url}, type : "sharingDirectory", isDrag : false});
				break;
				default:
				break;
			}
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
			
		},
		error: function (json)
		{
			//alert(111);
			//alert(json.error);
			//请求出错处理
		}
	});
}
/**************************************************
 *	读取文件更新列表 getFileUpdates()
 *	@param [fileID]	文件ID	
 *	@param [box]	填入容器	
 * 	@param [operationUrl]	操作链接	
 ***************************************************/
function getFileUpdates(){
	var strData = { "directories": $("#hiddenBaseDirectory").val(), "files" : $("#hiddenBaseFile").val()};
	$.ajax({
		type : "post",
		url : "/index.php?r=file/GetDirectoryContentUpdates",
		data : strData,
		dataType : "json",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			if(json.success){
				//$("#hiddenBaseDirectory").data("directory", strBaseDirectory).val(JSON.stringify(strBaseDirectory));
				//$("#hiddenBaseFile").data("file", strBaseFile).val(JSON.stringify(strBaseFile));
				var strBaseDirectory = $("#hiddenBaseDirectory").data("directory");
				var strBaseFile = $("#hiddenBaseFile").data("file");
				//console.log(json);
				//console.log(strBaseDirectory);
				var oJson;
				var i = 0;
				var html = "";
				if(json.dirs_to_add != null){
					oJson = json.dirs_to_add;
					for ( i in oJson){
						if(!$("li[folderID=" + oJson[i].storage_directory_id + "]").length){
							html +="<li class=\"folder\" folderID=\""+ oJson[i].storage_directory_id +"\">";
							html +="<section>";
							html +="<span></span>";
							html +="</section>";
							html +="<aside>";
							html +="<label for=\""+ oJson[i].storage_directory_id +"\" class=\"fileNameInfo Rows\">"+ oJson[i].name +"</label>";
							html +="<input type=\"text\" id=\""+ oJson[i].storage_directory_id +"\" class=\"fileNameText\" />";
							//htmlFile +="<div class=\"fileDate\">"+ data.updated +"</div>";
							html +="</aside>";
							html +="</li>";
							$(html).insertBefore($("#fileList").children("li").first());
						}
						//delete strBaseDirectory[i];
						strBaseDirectory[i] = oJson[i];
					}
					//console.log(strBaseDirectory);
					$("#hiddenBaseDirectory").data("directory", strBaseDirectory).val(JSON.stringify(strBaseDirectory));
				}
				if(json.dirs_to_update != null){
					oJson = json.dirs_to_update;
					for ( i in oJson){
						$("#fileList").children("li[folderid=" + oJson[i].storage_directory_id + "]").find("label.fileNameInfo").text(oJson[i].name);
						//delete strBaseDirectory[i];
						strBaseDirectory[i] = oJson[i];
					}
					//console.log(strBaseDirectory);
					$("#hiddenBaseDirectory").data("directory", strBaseDirectory).val(JSON.stringify(strBaseDirectory));
				}
				if(json.files_to_add != null){
					oJson = json.files_to_add;
					for ( i in oJson){
						if(!$("li[fileID=" + oJson[i].storage_file_index_id + "]").length){
							html +="<li drag=\"true\" fileID=\""+ oJson[i].storage_file_index_id +"\">";
							html +="<section>";
							html +="<span></span>";
							html +="</section>";
							html +="<aside>";
							html +="<label for=\""+ oJson[i].storage_file_index_id +"\" class=\"fileNameInfo Rows\">"+ oJson[i].file_name +"</label>";
							html +="<input type=\"text\" id=\""+ oJson[i].storage_file_index_id +"\" class=\"fileNameText\" />";
							//htmlFile +="<div class=\"fileDate\">"+ data.updated +"</div>";
							html +="</aside>";
							html +="</li>";
							$(html).insertBefore($("#fileList").children("li").first());
						}
						strBaseFile[i] = oJson[i];
					}
					$("#hiddenBaseFile").data("file", strBaseFile).val(JSON.stringify(strBaseFile));
				}
				if(json.files_to_remove != null){
					oJson = json.files_to_remove;
					for ( i in oJson){
						//console.log(oJson[i].storage_file_id);
						$("#fileList").children("li[fileid=" + oJson[i].storage_file_index_id + "]").remove();
						delete strBaseFile[i];
					}
					$("#hiddenBaseFile").data("file", strBaseFile).val(JSON.stringify(strBaseFile));	
				}
				if(json.files_to_update != null){
					oJson = json.files_to_update;
					for ( i in oJson){
						//console.log(oJson[i].storage_file_id);
						$("#fileList").children("li[fileid=" + oJson[i].storage_file_index_id + "]").find("label.fileNameInfo").text(oJson[i].file_name);
						strBaseFile[i] = oJson[i];
					}
					$("#hiddenBaseFile").data("file", strBaseFile).val(JSON.stringify(strBaseFile));
				}
				updataPosition($("#fileList"));
				//console.log($("#hiddenPosition").data("position"));
				$("#fileList").atomFile({data : {uid : $("#hiddenUser").data("uid"), did : "", url : "/"}, type : "full" });
			}
			//clearTimeout(getFileUpdates); 
			setTimeout("getFileUpdates()", 5000); 
			
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
			
		},
		error: function (error)
		{
			console.log(error);
			//alert("error");
			//请求出错处理
		}
	});
}
/**************************************************
 *	读取文件列表 getFile()
 *	@param [fileID]	文件ID	
 *	@param [box]	填入容器	
 * 	@param [operationUrl]	操作链接	
 ***************************************************/
function getFile(fileID, box, operationUrl){
	$.ajax({
		type : "get",
		url : operationUrl + "index.php?r=file/fileinfo",
		data : "fid="+fileID+"&callback=?",
		dataType : "jsonp",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			//alert("js-ok");
			//alert(nRandom);
			//fileName
			var sUers = {own : "", others : ""};
			$(box).children().children("header").children("h3").text(json.filename);
			//fileUpdateTime
			$(box).children().children("header").children("p").text(json.updated);
			$(box).children().children(".fileOperations").children(".downloadFile").children("a").attr({href: operationUrl + "index.php?r=file/downloadFile&fid=" + fileID + "&callback=?", title : "down" + "-" + json.filename + "-" + formatSize(json.size)});
			$(box).children().children(".fileOperations").children(".downloadFile").children("p").text( "(" + formatSize(json.size) + ")");
			$(box).children().children(".fileSareFrame").children("header").text( "Share with " + json.sharecount + " people :");
			for (var i in json.users){
				//console.log(i);
				if(json.users[i] == 5){
					sUers.own = i + "_";
				
				}else{
					sUers.others += i + "_";
				}
			}
			$(box).find(".hiddenShare").val(sUers.others.replace("remove_in_array_",""));
			$(box).find(".hiddenPeople").val(sUers.others.replace("remove_in_array_","") + sUers.own);
			//读取分享人员列表
			atomGetUser("fileShareUsers", sUers, {beforeBox : $(box).find("#addShare")});
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
/******************************************************************
 *	分享文件 shareOperations()
 *	@param [sData]		data 
 *	@param [sType]		操作类别   [ shareDirectory : 分享文件夹 | shareFile : 分享文件 ]
 *  @param [operationsUrl]	操作链接
 *	@param [obj]		操作对象列表 [ html : 需要加入的字符串 | box : 字符串容器 | hidden : 数据容器 | remove : 需要隐藏或删除的容器 ] 
 *
 ******************************************************************/
function shareOperations( sData, sType, operationUrl, obj ){
	switch (sType){
		case "shareDirectory":
			sUrl = operationUrl + "index.php?r=file/sharedirectory";
		break;
		case "shareFile":
			sUrl = operationUrl + "index.php?r=file/sharefile";
		break;
		case "unShareFile":
			sUrl = operationUrl + "index.php?r=file/setfilepermissions";
		break;
		case "unShareDirectory":
			sUrl = operationUrl + "index.php?r=file/setdirectorypermissions";
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
			if(json.success){
				switch (sType){
					case "shareDirectory":
						$(obj.html).insertBefore(obj.box);
						obj.remove.hide();
						//get left sharing user list
						getShareList( {uid : sData.uid }, operationUrl, "allShareUsers", {box : $("#fileUserList ul.userList")} );
					break;
					case "shareFile":
						getFile($("#hiddenFile").val(), "#fileInformation", operationUrl);
						//$(obj.html).insertBefore(obj.box.find("#addShare"));
						obj.remove.hide();
						//get left sharing user list
						getShareList( {uid : sData.uid }, operationUrl, "allShareUsers", {box : $("#fileUserList ul.userList")} );
					break;
					case "unShareFile":
						getFile($("#hiddenFile").val(), "#fileInformation", operationUrl);
						//obj.hidden.val(obj.hidden.val().replace((sData.uid+ "_"),""));
						//obj.remove.remove();
						//get left sharing user list
						getShareList( {uid : sData.own }, operationUrl, "allShareUsers", {box : $("#fileUserList ul.userList")} );
					break;
					case "unShareDirectory":
						//getFile($("#fileInformation").attr("fileid"), "#fileInformation", operationUrl);
						obj.hidden.val(obj.hidden.val().replace((sData.uid+ "_"),""));
						obj.remove.remove();
						//get left sharing user list
						getShareList( {uid : sData.own }, operationUrl, "allShareUsers", {box : $("#fileUserList ul.userList")} );
					break;
					default :
					break;
				}
			}else if (json.success){
				switch (sType){
					case "shareDirectory":
						$("#closeShareBox").click();
					break;
					default :
					break;
				}
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
 *	获取分享列表	 getShareList()
 *	@param [data]		data [did : directory id]
 *  @param [url]		ajax url
 *	@param [type]		[ shareDirectory : share directory | shareFile : share file ]
 *	@param [obj]		操作对象列表 [ html : 需要加入的字符串 | box : 字符串容器 | hidden : 数据容器 | remove : 需要隐藏或删除的容器 ] 
 *
 ******************************************************************/
function getShareList( data, url, type, obj ){
	var strUrl = "";
	switch (type){
		case "directoryList":
			strUrl = url + "index.php?r=file/getDirectoryUsers";
		break;
		case "allShareUsers":
			strUrl = url + "index.php?r=file/getSharingUsers";
		break;
		default :
		break;
	}
	var strUers = { own : "", others : ""};
	$.ajax({
		type : "get",
		url : strUrl,
		data : data,
		dataType : "jsonp",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			switch (type){
				case "directoryList":
					for (var i in json){
						if(json[i] == 5){
							strUers.own = i + "_";
						}else{
							strUers.others += i + "_";
						}
					}
					obj.box.find(".hiddenShare").val(strUers.others.replace("remove_in_array_",""));
					obj.box.find(".hiddenPeople").val(strUers.others.replace("remove_in_array_","") + strUers.own);
					//读取分享人员列表
					atomGetUser("directoryShareUsers", strUers, {beforeBox : obj.box.find(".textLi")});
				break;
				case "allShareUsers":
					obj.box.html("");
					var ajaxObj = {box : obj.box, operationUrl : url, userID : [], shareNum : []};
					strUers.own = data.uid;
					if(json != null){
						for (var i in json){
							strUers.others += i + "_";
							ajaxObj.userID.push(i);
							ajaxObj.shareNum.push(json[i]);
						}
					}
					atomGetUser("allShareUsers", strUers, ajaxObj);
				break;
				default :
				break;
			}
		},
		complete: function (XMLHttpRequest, textStatus)
		{
			//HideLoading();
		},
		error: function (json)
		{
			//alert(json);
		}
	});
}
/**************************************************
 *	返回文件大小 formatSize()
 *	@param [bytes] file size
 ***************************************************/
function formatSize(bytes){
	var i = -1;                                    
	do {
		bytes = bytes / 1024;
		i++;  
	} while (bytes > 99);
	
	return Math.max(bytes, 0.1).toFixed(1) + ['kB', 'MB', 'GB', 'TB', 'PB', 'EB'][i];          
}
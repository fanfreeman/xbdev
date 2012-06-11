/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
var $setFileUpdate;
var $setcommentList;
var $setAllShareUsers;
 $(document).ready(function() {
 	//初始化
 	$("#hiddenCancel").data("close", "true");
	 //调整左侧userlist高度
	$("#fileUserList ul.userList").atomPageAuto({ type : "height", num : 240 });
	//调整右侧fileMain宽度
	$("#fileMain").atomPageAuto({ type : "height", num : 100 });
	$("#fileMain").atomPageAuto({ type : "width", num : 235 });
	//$("#fileMain ul.fileList").setListMain();
	//窗口改变时动作
	$(window).resize(function(){
		 //调整左侧userlist高度
		$("#fileUserList ul.userList").atomPageAuto({ type : "height", num : 240 });
		//调整右侧fileMain宽度
		$("#fileMain").atomPageAuto({ type : "height", num : 100 });
		$("#fileMain").atomPageAuto({ type : "width", num : 238 });
	});
	$(document).click(function(){
		if(!$(".popWindow").is(":visible")){
			$("#operationList").children(".rename").show();
			$("#operationList").children(".share").attr("class", "shareDisabled");
			$("#operationList").children(".download").attr("class", "downloadDisabled");
			$("#operationList").children(".rename").attr("class", "renameDisabled");
			$("#operationList").children(".delete").attr("class", "deleteDisabled");
		}
		$("#fileList").children(".selected").removeClass("selected");
		//$("input.fileNameText:visible").blur();
	});
	//left userlist click
	$("#userListOwn").children("li").not("#friendsShared").click(function(){
		$("#fileUserList").find(".selected").removeClass("selected");
		$(this).addClass("selected");
	});
	//add comment
	$("#fileInformation").find(".sendBtn").click(function(){
		var str = $("#fileInformation").find(".sendText").val();
		//alert("js-ok");
		if(str != ""){
			fileOperations({intfileId : $("#hiddenFile").val(), strContent : str}, "/", "addComment", "");
			//fileOperations({intfileId : $("#hiddenFile").val()}, "/", "getComment", "");
		}
	});
	$("#operationList").children("li").click(function(e){
		e.stopPropagation();
		e.preventDefault();
	});
	//多选删除
	$("#operationList").children("li.delete").click(function(e){
		if ($(this).hasClass("deleteDisabled")) {return false;}
		var $select = $("#fileMain").find(".selected");
		var dirs = files = "";
		var n = $select.length;
		//console.log($("#fileList").children(".selected").length);
		if(n != 0){
			$("body").atomPop({
				headerText : "Delete Files ?",
				content : "Are you sure want to delete items from your atom ?",
				done : function(){
					for ( var i = 0 ; i < n ; i++ ){
						if ( $select.eq(i).hasClass("folder") ) {
							dirs += $select.eq(i).attr("folderid") + "_";
						}else{
							files += $select.eq(i).attr("fileid") + "_";
						}
					}
					//console.log(dirs, files);
					//alert("js-ok");
					fileOperations( { directories : dirs, files : files}, "/", "removeItems", { remove : $select });
				}
			});
		}
	});
	//重命名
	$("#operationList").children("li.rename").click(function(e){
		if ($(this).hasClass("renameDisabled")) {return false;}
		var $select = $("#fileMain").find(".selected");
		if ( $select.length == 1 ){
			$("#fileList").children("li").removeClass("selected");
			var oLabel = $select.find("label.fileNameInfo");
			var oText = $select.find("input.fileNameText");
			oLabel.hide();
			oText.show().val(oLabel.text()).focus();
		}
	});
	//download
	$("#operationList").children("li.download").click(function(e){
		if ($(this).hasClass("downloadDisabled")) {return false;}
		var $select = $("#fileMain").find(".selected");
		var folderid = fileid = "";
		if($select.length != 0){
			for ( var i = 0 ; i < $select.length ; i++ ){
				if ($select.eq(i).hasClass("folder")){
					folderid  += $select.eq(i).attr("folderid") +"_";
				}
				else{
					fileid  += $select.eq(i).attr("fileid") +"_";
				}
			}
			window.location.href = "/file/download?dids=" + folderid + "&fids=" + fileid + "&callback=?";
		}
	});
	//shares
	$("#operationList").children("li.share").click(function(e){
		//alert("js-ok");
		if ($(this).hasClass("shareDisabled")) {return false;}
		var $select = $("#fileMain").find(".selected");
		var fileid = folderid = "";
		if ( $select.length == 1 ){
			if ($select.hasClass("folder")){
				folderid = $select.attr("folderid");
				$("#hiddenDirectory").val(folderid);
				$("body").atomPop({
					popClass : "shareBox",
					headerText : "Share",
					isTips : false,
					hasCancel : false,
					content : '<div class="addPeopleBlock fl pr">'+
					            '<ul class="addPeopleShow notPopWindow fl">'+
					                '<li class="textLi"><input type="text" class="addPeopleText" size="1" placeholder="Share with..." /><ul class="completionUserList"></ul></li>'+
					            '</ul>'+
					            '<input type="hidden" class="hiddenShare" value="" />'+
					            '<input type="hidden" class="hiddenPeople" value="" />'+
					          '</div>'+
					          '<div class="ClearBoth"></div>',
					cancel : function(){
								$("#hiddenDirectory").val("");
							}
				});
				getShareList({did : folderid}, "/", "directoryList", { box : $("#tipsPop") });
				//share directory
				$(".shareBox .addPeopleBlock").atomSearchPeople({ type: "directoryShare", uid : $("#hiddenUser").data("uid"), operationsUrl : "/"});
			}
			else{
				fileid = $select.attr("fileid");
				$("#hiddenFile").val(fileid);
				$("body").atomPop({
					popClass : "shareBox",
					headerText : "Share",
					isTips : false,
					hasCancel : false,
					content : '<div class="addPeopleBlock fl pr">'+
					            '<ul class="addPeopleShow notPopWindow fl">'+
					                '<li class="textLi"><input type="text" class="addPeopleText" size="1" placeholder="Share with..." /><ul class="completionUserList"></ul></li>'+
					            '</ul>'+
					            '<input type="hidden" class="hiddenShare" value="" />'+
					            '<input type="hidden" class="hiddenPeople" value="" />'+
					          '</div>'+
					          '<div class="ClearBoth"></div>',
					cancel : function(){
								$("#hiddenFile").val("");
							}
				});
				getShareList({fid : fileid}, "/", "fileList", { box : $("#tipsPop") });
				//share file
				$(".shareBox .addPeopleBlock").atomSearchPeople({ type: "shareItemsFile", uid : $("#hiddenUser").data("uid"), operationsUrl : "/"});
			}
			//$("#shareBox")
		}
		//share folders and files
		if ( $select.length > 1 ){
			for ( var i = 0 ; i < $select.length ; i++ ){
				if ($select.eq(i).hasClass("folder")){
					folderid  += $select.eq(i).attr("folderid") +"_";
				}
				else{
					fileid  += $select.eq(i).attr("fileid") +"_";
				}
			}
			$("body").atomPop({
				popClass : "shareBox",
				headerText : "Share",
				isTips : false,
				content : '<div class="addPeopleBlock fl pr">'+
				            '<ul class="addPeopleShow notPopWindow fl">'+
				                '<li class="textLi"><input type="text" class="addPeopleText" size="1" placeholder="Share with..." /><ul class="completionUserList"></ul></li>'+
				            '</ul>'+
				            '<input type="hidden" class="hiddenShare" value="" />'+
				            '<input type="hidden" class="hiddenPeople" value="" />'+
				          '</div>'+
				          '<div class="ClearBoth"></div>',
				done: function(){
						if ($("#tipsPop").find(".hiddenShare").val() != ""){
							shareOperations({ users : $("#tipsPop").find(".hiddenShare").val(), directories : folderid, files : fileid}, "shareitems", "/", "");
						}else{
							$("#tipsPop").find(".cancel").click();
						}
					  }
			});
			$(".shareBox .addPeopleBlock").atomSearchPeople({ type: "itemsShare", uid : $("#hiddenUser").data("uid"), operationsUrl : "/"});
			
		}
	});
	$(document).on("keydown", function(e){
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		if ($("#fileList").children("li.selected").length != 0){
			if(keyCode == 8 || keyCode == 46) {
				e.preventDefault();
				//alert("js-ok");
				$("#operationList").children("li.delete").click();
				return false;
			}
		}
		if (keyCode == 13 && $("#tipsPop").is(":visible")){
			e.preventDefault();
			if($("#hiddenCancel").data("close") == "true"){ $("#tipsPop").find(".done").click(); }
			//$("#tipsPop").find(".done").click();
			return false;
		}
		if ($("#fileList").children("li.selected").length == 1 && $(".commonPop").is(":hidden")){
			if(keyCode == 13){
				//alert("js-ok");
				$("#fileList").children("li.selected").find("label.fileNameInfo").click();
				return false;
			}
		}
		
		if (keyCode == 13 && $(".shareBox").is(":visible") && $(".shareBox").find(".completionUserList").is(":hidden")){
			e.preventDefault();
			$("#shareBox").find(".done").click();
			return false;
		}
	});
	//new
});
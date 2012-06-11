/*  2012-02-17 message        版本1.0beta
 **  Atom  message页面执行部分             联系邮箱：xuchen011@sina.com
 **  制作人：徐晨(cssghost)
 */
 var windowsOnfocus = true;
window.onblur   =   function(){    windowsOnfocus = false;} 

Array.prototype.remove = function(obj)
{for ( var i=0 ; i < this.length ; ++i ){if ( this[i] == obj ){if ( i > this.length/2 ){for ( var j=i ; j < this.length-1 ; ++j ){this[j] = this[j+1];}this.pop();}else{for ( var j=i ; j > 0 ; --j ){this[j] = this[j-1];}this.shift();}break;}}}
//判断数组是否有与该值相同的元素
Array.prototype.in_array = function(e){for(i=0;i<this.length && this[i]!=e;i++);return !(i==this.length);}
var imvod=new Audio('/images/im.wav');
var array_message_group_ids = new Array();
 $(document).ready(function() {
	//调整左侧userlist高度
	$("#messageUserList ul.userList").atomPageAuto({ type : "height", num : 89 });
	//调整右侧informationRecorded宽度
	$("#informationRecorded").atomPageAuto({ type : "width", num : 240 });
	//调整右侧senderShow宽度	
	$("#senderFrame ul.senderShow").atomPageAuto({ type : "width", num : 410 }); 
	//调整右侧messagelist高度
	$("#informationRecorded ul.messageList").setMessageListHeight();
	//调整右侧sendMessage宽度
	$("#sendMessageFrame .sendText").atomPageAuto({ type : "width", num : 375 });
	//窗口改变时动作
	$(window).resize(function(){
		//调整左侧userlist高度
		$("#messageUserList ul.userList").atomPageAuto({ type : "height", num : 89 });
		//调整右侧informationRecorded宽度
		$("#informationRecorded").atomPageAuto({ type : "width", num : 240 });
		//调整右侧senderShow宽度	
		$("#senderFrame ul.senderShow").atomPageAuto({ type : "width", num : 410 });
		//调整右侧messagelist高度
		$("#informationRecorded ul.messageList").setMessageListHeight();
		//调整右侧sendMessage宽度
		$("#sendMessageFrame .sendText").atomPageAuto({ type : "width", num : 375 });	
	});
	//添加新聊天
	$("#messageSearchFrame div.addMessage").atomMessageCreatMessages();
	//左侧人名搜索
	$("#messageSearchFrame").find(".SearchText").atomSearchList({ searchList : ".userList" , type:"message"});
	//左侧userlist选中效果
//	$("#messageUserList ul.userList>li:not('#newMessage')").live("click", function(){
//		//alert("js-ok");
//		var oThis = $(this);
//		oThis.removeClass('online');
//		var oSendFrame = $("#senderFrame");
//		if($("#newMessage").is(":visible")){
//			$("#newMessage").slideUp();
//		}
//		oThis.addClass("selected").siblings("li").removeClass("selected");
//		oThis.clone().insertAfter($("#newMessage"));
//		oThis.remove();
//		var oTextLi = $("#peopleText");
//		$("#messageOperation").children(".deleteBtn").show();
//		oSendFrame.children(".senderShow").children("li").not(oTextLi).remove();
//		$("#sendMessageFrame").children(".sendText").focus();
//		//韩磊在这里添加本messageList组里的人名
//		//html+="<li class="nameShow">";
//		//html+="<p class="fl">chen pengfei</p>";
//		//html+=" </li>";
//		//$(html).insertAfter(oTextLi);
//	});
	//输入发送人text
	//$("#peopleText .addPeopleText").bind("keyup", function(event){
//		var oThis = $(this);
//		var oNameList = $(this).next("ul.completionUserList"); 
//		var str_search = $(this).val();
//		var keys = {
//			enter:  13,
//			escape: 27,
//			up:     38,
//			down:   40,
//			array:  [13, 27, 38, 40]
//		}
//		oNameList.show();
//		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
//		if($.inArray(keyCode, keys.array) !=-1){
//			switch (keyCode){
//				case keys.up:
//					if(oNameList.is(":visible")){
//						if (oNameList.children().hasClass("selected")){
//							oNameList.children(".selected").prev().addClass("selected").siblings().removeClass("selected");
//						}else{
//							oNameList.children().eq("0").addClass("selected");
//						}
//					}
//				break;
//				case keys.down:
//					if(oNameList.is(":visible")){
//						if (oNameList.children().hasClass("selected")){
//							oNameList.children(".selected").next().addClass("selected").siblings().removeClass("selected");
//						}else{
//							oNameList.children().eq("0").addClass("selected");
//						}
//					}else{
//						//getCompletionUserList(str_search, oNameList,{$message_group_id});
//					}
//				break;
//				case keys.enter:
//					if(oNameList.is(":visible")){
//						if (oNameList.children().hasClass("selected")){
//							oNameList.children(".selected").click();
//						}else{
//							oNameList.children("li").eq(0).click();
//						}
//					}
//					//if(oThis.val() != ""){
//						//韩磊在这里执行加人操作，成功后执行下面代码
//						//if (oThis.attr("nameID"))
//						//{
//							//var friend_id = oThis.attr("nameID");
//							
//							//oThis.attr("nameID","");
//						//}
//					//}
//				break;
//				default :
//				break;
//			}
//		}else{
//			if(str_search!=""){
//				//getCompletionUserList(str_search, oNameList,{$message_group_id});
//			}
//		}
//	});
	//输入发送人text退格键操作，只能绑定keydown
//	$(".addPeopleText").bind('keydown', function(event){
//		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
//		var oThis = $(this);
//		var oNameList = $("ul.completionUserList"); 
//		if(keyCode == 8) {
//			if(oThis.val() === ""){
//				if(oNameList.is(":visible")){ oNameList.hide(); }
//				if(oThis.parent("li").prevAll("li.name").length > 0){
//					oThis.parent("li").prev(".name").find(".deleteName").click();
//				}
//			}
//		}
//	});
	//快速补全userNameList
	$("li.imQuickLi").live("click", function(){
		//alert("js-ok");
		var oThis = $(this);
		var oHidden = $(".hiddenPeople");
		var oText = $(".addPeopleText");
		var oMessageTo = $("#messageTo");
		var html = "<li class=\"name\"><p class=\"fl\">" + oThis.attr("name") + "</p><a href=\"#\" class=\"deleteName fr\" title=\"delete " + oThis.attr("name") + "\" nameID=\"" + oThis.attr("nameID") + "\"></a></li>";
		$(html).insertBefore(oText.parent("li"));		
		oHidden.val(oHidden.val() + oThis.attr("nameID") + "_");
		oText.val("");
		//oThis.parent("ul.completionUserList").hide().html("");
		oThis.parent("ul.completionUserList").hide();
		//调整右侧messagelist高度
		$("#informationRecorded ul.messageList").setMessageListHeight();
		oText.focus();
	});
	//删除已选中user列表中的user
	$(".deleteName").live("click", function(e){
		e.preventDefault();		
		var oThis = $(this);
		var oHidden = $(".hiddenPeople");
		var nameID = oHidden.val().replace((oThis.attr("nameID") + "_"),"");
		oHidden.val(nameID);
		oThis.parent("li.name").remove();
		//调整右侧messagelist高度
		$("#informationRecorded ul.messageList").setMessageListHeight();
	});
	//sendText输入框自动调整高度
	$("#sendMessageFrame").find(".sendText").live("paste cut keydown keyup focus blur", function(e){
		var oThis = $(this);
		var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;
		//alert("js-ok");
		var height,style=this.style;
		this.style.height = '20px';
		if (this.scrollHeight > 29) {
			if (60 && this.scrollHeight > 60) {
				height = 60;
			} else {
				if ($.browser.mozilla){height = this.scrollHeight;}
				else{height = this.scrollHeight - 10;}
			}
			style.height = height  + 'px';
		}
		//调整右侧messagelist高度
		$("#informationRecorded ul.messageList").setMessageListHeight();
	});
	//new
});

//点击左侧人名刷新右侧聊天记录
function loadAtomMessages(all_members,other_members,message_group_id,last_message_id){
	messageAjax('loadAtomMessages','get',"/Message/loadMessages",{all_members : all_members,other_members : other_members,message_group_id:message_group_id,last_message_id:last_message_id});
	$('.userList li').removeClass('selected');
	$('#li_chatgroup_'+message_group_id).addClass('selected');
	array_message_group_ids.remove(message_group_id);
	}
	
function refresh_last_message(message_group_id,message_sended)
{
	$('#li_chatgroup_'+message_group_id+' .p_last_message').html(message_sended);
}
function move_to_top(message_group_id)
{
	var obj = $('#li_chatgroup_'+message_group_id);
	obj.clone().insertAfter('#newMessage');
	obj.remove();
}
function checkMessages()
{
$.ajax({
			type : 'get',
			url : "/Message/LoadCheckMessage",
			data:'',
			dataType : "json",
			cache : true,
			beforSend : function(XMLHttpRequest){
			},
			success : function (json){
				if(json.success)
				{
					if(json.has_data)
					{
						var message_group_id = json.array_json['0'].message_group_id;
						var last_message_id = json.array_json['0'].last_message_id;
						var last_message_message = json.array_json['0'].last_message_message;
						if($('#li_chatgroup_'+message_group_id).length)
						{
							//if(!array_message_group_ids.in_array(message_group_id))
							{
								//array_message_group_ids.push(message_group_id);
								var senderFrame_id = $('#senderFrame').attr('item_id');
								refresh_last_message(message_group_id,last_message_message);
								if(message_group_id == senderFrame_id)
								{
									messageAjax('GetNoreadMessage','get',"/Message/GetNoreadMessage",{message_group_id : message_group_id,last_message_id:last_message_id});
									
									if(!windowsOnfocus)
									{
										imvod.play();
										windowsOnfocus = true;
									}
									
								}
								else
								{
									$('#li_chatgroup_'+message_group_id).addClass("online");
									//发声
									if(!array_message_group_ids.in_array(message_group_id))
									{
										array_message_group_ids.push(message_group_id);
										imvod.play();
									}
								}
							}
							move_to_top(message_group_id);
						}
						else
						{
						//没有左侧对话框，添加对话框
						messageAjax('LoadNewMessageGroup','get',"/Message/LoadNewMessageGroup",{message_group_id : message_group_id});
						//发声
						imvod.play();
						}
					}
					else
					{
					//没有新数据	
					}
				}
				else
				{
					console.log(json.error);
					//alert(json.error);
				}
			},
			complete: function (XMLHttpRequest, textStatus)
			{
			},
			error: function (json)
			{
				//alert(json.error);
			}
		});	
setTimeout(checkMessages, 1000 );
}	
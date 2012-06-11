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
					$("#"+ obj.attr("alt")).find(".sendText").focus();
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
					$("#"+ obj.attr("alt")).find(".sendText").focus();
				});
			}
		}
	}else {
		obj.find(".off").click();
		$("#"+ obj.attr("alt")).find(".sendText").focus();
	}
	
	
}

//数组删除该值的元素
Array.prototype.remove = function(obj)
{for ( var i=0 ; i < this.length ; ++i ){if ( this[i] == obj ){if ( i > this.length/2 ){for ( var j=i ; j < this.length-1 ; ++j ){this[j] = this[j+1];}this.pop();}else{for ( var j=i ; j > 0 ; --j ){this[j] = this[j-1];}this.shift();}break;}}}
//判断数组是否有与该值相同的元素
Array.prototype.in_array = function(e){for(i=0;i<this.length && this[i]!=e;i++);return !(i==this.length);}
var var_flash_title = false;
function set_title()
{
var_flash_title = true;
document.title="New Message";
flash_title1 = setTimeout("reset_title()", 500);  
}
function reset_title()
{
document.title="-";
flash_title2 = setTimeout("set_title()", 500);  
}
/*
function checkMessage()
{
$.ajax({
		type : "get",
		url : CONTROLLER_URL+"Im/LoadCheckMessage",
		success : function (html){
			if(html)
				{
				var tst=eval("("+html+")"); 
				var message_group_id = tst.message_json[0].message_group_id;
				var type = tst.message_json[0].type;
				if(!newmessage_session.in_array(message_group_id))
					{
					newmessage_session.push(message_group_id);
					if($("#imBlock" + message_group_id).length ==0){
					//$(".imMessageBLock[alt="+message_group_id+"]").;
					set_title();
					var oThis = $(this);
					var html = hWin ="";
					var nID = message_group_id;
					var oBlock,isShow;
					$.get(CONTROLLER_URL+"im/GetNoreadMessage&showtype=two_user&message_group_id="+message_group_id+"&last_message_id="+tst.message_json[0].last_message_id,function(newmessages)
						{		
							$.get(CONTROLLER_URL+"im/LoadMessageHistory&message_group_id="+nID, function(messages)
							{
								$.get(CONTROLLER_URL+"im/LoadWindowsChater&message_group_id="+nID, function(result)
								{
								$(result).appendTo("body");
									$(messages).appendTo('#ul_chatlist'+nID);
									//console.log($('#ul_chatlist'+nID).children().length);
									scrolldown(nID);
									$("#imBlock" + nID).hide();
									newmessage_session.remove(message_group_id);
									$(".imMessageBlock"+message_group_id+" header").addClass("imMessageHeadTips");
								});	
							});
						});
					}
					else
					{
					$.get(CONTROLLER_URL+"im/GetMessageShowType&message_group_id="+message_group_id+"&last_message_id="+tst.message_json[0].last_message_id,function(showtype)
						{	
						$.get(CONTROLLER_URL+"im/GetNoreadMessage&showtype="+showtype+"&message_group_id="+message_group_id+"&last_message_id="+tst.message_json[0].last_message_id,function(newmessages){
							if(showtype=="one_user")
							{
								//$("#ul_chatlist"+message_group_id+" li.messages:last-child").append(newmessages);
								$("#ul_chatlist"+message_group_id).children("li").last().children("aside").append(newmessages);
								//$("#ul_chatlist"+message_group_id).append(newmessages);
								newmessage_session.remove(message_group_id);	
								scrolldown(message_group_id);
								if($("#imBlock" + message_group_id).is(":hidden")) {$(".imMessageBlock"+message_group_id+" header").addClass("imMessageHeadTips");set_title(); }
							}
							else if (showtype=="two_user")
							{
								//alert(newmessages);
								$("#ul_chatlist"+message_group_id).append(newmessages);
								newmessage_session.remove(message_group_id);	
								scrolldown(message_group_id);
								if($("#imBlock" + message_group_id).is(":hidden")) {$(".imMessageBlock"+message_group_id+" header").addClass("imMessageHeadTips"); set_title();}
							}
							
							});
							
							
							//scrolldown(message_group_id);
										
						});			
					}
					//chang color
					
				}
			}

			},
		error: function (error)
		{
			alert(error);
		}
	});
$.get(CONTROLLER_URL+"Im/LoadCheckOnline", function(online_json)
{
	var user_online=eval("("+online_json+")"); 
	//({'count':'3'},{"online_json":[{"user_id":"1","online":"1"},{"user_id":"3","online":"0"},{"user_id":"4","online":"0"}]})
	var sum = user_online.online_json.length;
	for (var i = 0;i<sum;i++)
	{
		var user_id = user_online.online_json[i]['user_id'];
		var online = user_online.online_json[i]['online'];
		if (online=='1')
		{$('#user_online_'+user_id).addClass('online');}
		else
		{$('#user_online_'+user_id).removeClass('online');}
	}
});	
setTimeout(checkMessage, 1000 );
}
*/

var imvod=new Audio('/images/im.wav');

function add_friends(message_group_id)
{
	var friend_id = $('#hiddenPeople'+message_group_id).val();
	if (friend_id!='')
	{
		update_message_group(message_group_id,friend_id);
	}
}

function update_message_group(message_group_id,friend_id)
{
	$.get("/im/Update_Message_Group&message_group_id="+message_group_id+"&friend_id="+friend_id,function(result)
			{		
					//alert(result);
			});
}

function refresh_group(message_group_id)
{
$.get("/im/RefreshGroup&message_group_id="+message_group_id,function(result)
									{		
										$("#imBlock"+message_group_id+" h6.chater_name").html(result);
										$(".imMessageBlock"+message_group_id+" h6.chater_name").html(result);
									});
}

function leave_chatgroup(message_group_id,obj)
{
$.get("/im/LeaveChatGroup&message_group_id="+message_group_id,function(result)
									{		
											obj.parents(".imMessageBlock").find("span.closeIM").click();
																					
									});
}

function scrolldown(message_group_id)
	{
		
		var num = $("#ul_chatlist"+message_group_id).children("li").length;
		var sum_height=0;
		for (var i =0;i<num;i++)
		{
			var li_height = $("#ul_chatlist"+message_group_id).children("li").eq(i).outerHeight(true);
			sum_height = sum_height + li_height;
		}
		//console.log(sum_height);
		//alert(sum_height);
		if(sum_height > 160){$("#ul_chatlist"+message_group_id).scrollTop(sum_height-160);}
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
						if($("#imBlock" + message_group_id).length ==0)
						{
							var oThis = $(this);
							var html = hWin ="";
							var oBlock,isShow;
							imAjax('LoadWindowsChater','get',"/Im/LoadWindowsChater",{message_group_id : message_group_id,load_type : 'check_message'});
							//发声
							imvod.play();
						}
						else
						{
							imAjax('GetNoreadMessage','get',"/Im/GetNoreadMessage",{message_group_id : message_group_id,last_message_id : last_message_id});
						}
					}
					else
					{
					//没有新数据	
					}
					for(var i = 0;i<json.array_online.length;i++)
					{
						//alert(json.array_online[i]['online']);
						if (json.array_online[i]['online']=='1')
						{
							$('#imUserList .userList').find("span[item_id=" + json.array_online[i]['user_id'] + "]").removeClass('offline').addClass('online');
						}
						else
						{
							$('#imUserList .userList').find("span[item_id=" + json.array_online[i]['user_id'] + "]").removeClass('online').addClass('offline');
						}
						
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

function imAjax(function_for,type,url,data){
	$.ajax({
			type : type,
			url : url,
			data : data,
			dataType : "json",
			cache : true,
			beforSend : function(XMLHttpRequest){
			},
			success : function (json){
				if(json.success)
				{
					var html = hWin ="";
					var oBlock,isShow;
					switch (function_for){
					case "LoadCreatMessage_group" :
						var message_group_id = json.message_group_id;
						var oThis = $(this);
						if($("#imBlock" + message_group_id).length ==0)
						{
						imAjax('LoadWindowsChater','get',"/Im/LoadWindowsChater",{message_group_id : message_group_id,load_type : 'list_click'});
						}
						oBlock = $(".imMessageBlock[alt=imBlock" + message_group_id +"]");
						IMMove(oBlock);
					break;
					case "LoadWindowsChater" :
						$(json.html).appendTo("body");
						$("#imBlock" + data.message_group_id).hide();
						if(data.load_type == 'check_message')
						{
							$(".imMessageBlock"+data.message_group_id+" header").addClass("imMessageHeadTips");
						}
						else if(data.load_type == 'list_click')
						{
							oBlock = $(".imMessageBlock[alt=imBlock" + data.message_group_id +"]");
							IMMove(oBlock);
						} 
					break;
					case "SendMessage" :
						$("#ul_chatlist"+data.message_group_id).append(json.html);
						scrolldown(data.message_group_id);
					break;
					case "GetNoreadMessage" :
						$("#ul_chatlist"+data.message_group_id).append(json.html);
							scrolldown(data.message_group_id);
						if($("#imBlock" + data.message_group_id).is(":hidden")) {
							$(".imMessageBlock"+data.message_group_id+" header").addClass("imMessageHeadTips"); 
							//发声
							imvod.play();
							//alert('good');
							}
					break;
					case "Create_Message_Group" :
						imAjax('LoadWindowsChater','get',"/Im/LoadWindowsChater",{message_group_id : json.message_group_id,load_type : 'list_click'});
					break;
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
				//HideLoading();
			},
			error: function (json)
			{
				//alert(json.error);
			}
		});
	}			
	
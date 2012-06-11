//定义局部变量
//var CONTROLLER_URL = "/index.php?r="; 
var right_index = 0; //左边栏计数
var left_index = 0;//右边栏计数
var current_index;//当前index
var n_chatbox = 1; //一页显示的对话框个数
var chat_window_witdh = 268;
var sum = 0; //打开聊天窗口总数
var active_box_session; //当前打开聊天窗口session
var newmessage_session = new Array();
//数组删除该值的元素
Array.prototype.remove = function(obj)
{for ( var i=0 ; i < this.length ; ++i ){if ( this[i] == obj ){if ( i > this.length/2 ){for ( var j=i ; j < this.length-1 ; ++j ){this[j] = this[j+1];}this.pop();}else{for ( var j=i ; j > 0 ; --j ){this[j] = this[j-1];}this.shift();}break;}}}
//判断数组是否有与该值相同的元素
Array.prototype.in_array = function(e){for(i=0;i<this.length && this[i]!=e;i++);return !(i==this.length);}


$(document).ready(function()
	{//点击左下角，弹出聊天者列表
		$(".active_chat").click(function()
			{loadListChater();});	
		//临时解决方案
		loadListChater();
		//根据页面宽度，计算聊天窗口个数
		math_n_chatbox();
		//窗口宽度变化时，重新计算聊天窗口个数
		$(window).resize(function()
			{
				old_n_chatbox = n_chatbox;
				math_n_chatbox();
				if(old_n_chatbox!=n_chatbox)
					{
						if(old_n_chatbox>n_chatbox)
							{
								if(sum-n_chatbox>0)
									{
										left_index = left_index+(old_n_chatbox-n_chatbox);
										initializing_left_right();
									}
							}
				else if(old_n_chatbox<n_chatbox)
				{
					if(left_index>0)
						{
							left_index = left_index+(old_n_chatbox-n_chatbox);
							initializing_left_right();
						}
				}
			}
			
		});	
	})
	
	//根据窗口宽度计算聊天窗口个数	
	function math_n_chatbox()
	{
		var width = $(this).width();
		n_chatbox = parseInt((width-300)/chat_window_witdh);
		var new_width = n_chatbox*chat_window_witdh;
		$(".im_content_chat").css("width",new_width+"px");	
	}
	
	//删除对话框
	function closeChatWindows(chat_session)
		{
			sum--;
			if(right_index>0)
				{
					right_index--;
					current_index--;
					initializing_left_right()
					ul_animate(-1);
				}
			else
				{
					if(left_index>0)
						{
							left_index--;
							initializing_left_right()
						}
				}	
		}

	//读取聊天者列表
	function loadListChater()
		{
			$.get(CONTROLLER_URL+"im/LoadListChater", function(result)
				{
					$(".im_chat").html(result);
				});
			checkMessage();	   
		} 
		
	function CreatMessage_group(id_chater)
		{
			$.get(CONTROLLER_URL+"im/LoadCreatMessage_group&id_chater="+id_chater, function(message_group_id)
				{
					loadChatWindows(message_group_id);
				});
		}	
		
	
	//点击用户名，展开聊天窗口功能		
	function loadChatWindows(message_group_id){
		item_stat = check_status_chatwindows(message_group_id); 
		switch(item_stat)
		{	
			case "li_chat_windows_close":  //该对话框还没有打开
				$.get(CONTROLLER_URL+"im/LoadWindowsChater&message_group_id="+message_group_id, function(result)
					{
					
						//将打开的窗口关闭，前端插入新聊天窗口，同时将当前index设置为新打开窗口
						if(active_box_session)
						{
							$("#chat_windows"+active_box_session).change_status_active("self","noactive");
						}
						$(".ul_im_content_chat").append(result);
							//当总窗口大于等于所能展开的窗口数是，右index加1同时做位移
							if (sum>=n_chatbox)
								{
									right_index = right_index +sum - current_index;
									move_d = sum - current_index;
									left_index = 0;
									initializing_left_right();
									ul_animate(move_d);	
								}
								current_index = $("#chat_windows"+message_group_id).index();
								active_box_session = message_group_id;
								sum++;					
						});
			break
			case "li_chat_windows_open_noactive": 			
						$("#chat_windows"+active_box_session).change_status_active("self","noactive");
						$("#chat_windows"+message_group_id).change_status_active("self","active");
						
						var goto_index = $("#chat_windows"+message_group_id).index();
						slide_move(goto_index);
						active_box_session = message_group_id;
						if($("#chat_windows"+message_group_id).children(".chat_windowsTitle").hasClass("chat_windowsTitle_active"))
						{
							$("#chat_windows"+message_group_id).change_status_active("child","noactive");
						}
						scrolldown(message_group_id);
						break			
			case "li_chat_windows_open_active": 
						var goto_index = $("#chat_windows"+message_group_id).index();
						slide_move(goto_index);
						break
		}
	
	}

	function check_status_chatwindows(message_group_id){
		var element_chatwindows = $("#chat_windows"+message_group_id);
		if(element_chatwindows.length)
		 {
		//该聊天窗口已打开 
			if ($("#chat_windows"+message_group_id).hasClass("li_chat_windows_open_active"))
				{
					return "li_chat_windows_open_active";
				}
			else if($("#chat_windows"+message_group_id).hasClass("li_chat_windows_open_noactive"))
				{
					return "li_chat_windows_open_noactive";
				}
		}
		 else
		{
		//该聊天窗口未打开
		return "li_chat_windows_close";
		}
	}
	
	$.fn.change_status_active = function(targ,switchto) {
	if(targ=="self")
		{
			switch(switchto)
				{
				case "noactive": 
				$(this).removeClass("li_chat_windows_open_active").addClass("li_chat_windows_open_noactive");	
				break
				case "active": 
				$(this).removeClass("li_chat_windows_open_noactive").addClass("li_chat_windows_open_active");	
				break
				}
		}
	else if(targ=="child")
		{
		switch(switchto)
				{
				case "noactive": 
				$(this).children(".chat_windowsTitle").removeClass("chat_windowsTitle_active").addClass("chat_windowsTitle_noactive");
				break
				case "active": 
				$(this).children(".chat_windowsTitle").removeClass("chat_windowsTitle_noactive").addClass("chat_windowsTitle_active");
				break
				}		
		}
	else if(targ=="bord")
		{
		switch(switchto)
				{
				case "noactive": 
				$(this).removeClass("im_leftright_active").addClass("im_leftright_noactive");
				break
				case "active": 
				$(this).removeClass("im_leftright_noactive").addClass("im_leftright_active");
				break
				}		
		}
	}

function slide_move(goto_index)
{
	if ((current_index-goto_index)>(n_chatbox-1))
		{
			move_d = goto_index-current_index+(n_chatbox-1);
			right_index = right_index - (current_index-goto_index-(n_chatbox-1));
			left_index = left_index + (current_index-goto_index-(n_chatbox-1));
			current_index = goto_index+(n_chatbox-1); 
			initializing_left_right();
			ul_animate(move_d);	
			}
		else if((current_index-goto_index)<0)
		{
			move_d = (current_index-goto_index) * (-1);						
			right_index = right_index + (goto_index - current_index);
			left_index = left_index - (goto_index - current_index);	
			current_index = goto_index; 	
			initializing_left_right();
			ul_animate(move_d);	
			}	
}



function ul_animate(move_d)
	{
		var oImgList = $(".ul_im_content_chat");
		oImgList.stop(true,true).animate({right : "-=" + move_d*chat_window_witdh}, 600,function(){
			var activebox_position = check_box_position(active_box_session);	
			//打开窗口进入左侧或右侧区域，则将至关闭
			if (activebox_position=="left"||activebox_position=="right")
			{
				$("#chat_windows"+active_box_session).change_status_active("self","noactive");
			}
			});	
	}
function initializing_left_right()
	{
		if(right_index>=0)
			{
				$(".im_right").html(">"+right_index+">");	
				if (right_index!=0)
					{
						if($(".im_right").hasClass("im_leftright_active"))
						{
							var change_color = 1;
							for(var count=0; count<right_index;count++)
							{
								if($(".chat_windows:eq("+count+")").children(".chat_windowsTitle").hasClass("chat_windowsTitle_active"))
								{
								change_color = 0;
								}
							}
							if (change_color)
							{
								$(".im_right").change_status_active("bord","noactive");
							}
						}
						if (newmessage_session.length)
							{
								for(var i=0;i<=newmessage_session.length-1;i++)
								{
									change_leftright_active(newmessage_session[i]);	
								}
							}
						$(".im_right").show();	
					}
				else
					{
						//$(".im_right").removeClass("im_leftright_active").addClass("im_leftright_noactive");
						$(".im_right").hide();	
					}
			}
		if(left_index>=0)
			{
				$(".im_left").html("<"+left_index+"<");	
				if (left_index!=0)
						{
							if($(".im_left").hasClass("im_leftright_active"))
							{
								var change_color = 1;
								for(var count=0; count<left_index;count++)
								{
									if($(".chat_windows:eq("+eval(right_index+n_chatbox+count)+")").children(".chat_windowsTitle").hasClass("chat_windowsTitle_active"))
									{
									change_color = 0;
									}
								}
								if (change_color)
								{
									$(".im_left").change_status_active("bord","noactive");
								}
							}								
							if (newmessage_session.length)
							{
								for(var i=0;i<=newmessage_session.length-1;i++)
								{
									change_leftright_active(newmessage_session[i]);	
								}
							}
							$(".im_left").show();	
						}
					else
						{
							//$(".im_left").removeClass("im_leftright_active").addClass("im_leftright_noactive");
							$(".im_left").hide();	
						}
			}
	}	
	
	function im_switch(direction){
		switch(direction)
			{
			case "left":
			right_index--;
			left_index++;
			current_index--;
			initializing_left_right()
			ul_animate(-1);
			break
			case "right":
			//$(".im_left_active").removeClass("im_left_active").addClass("im_left");
			right_index++;
			left_index--;
			current_index++;
			initializing_left_right()
			ul_animate(1);
			break
			}
		}	
			
	function scrolldown(message_group_id)
	{
		$("#chat_history"+message_group_id).scrollTop($("#ul_chatlist"+message_group_id).height());
	}
	
	function change_leftright_active(message_group_id)
	{
			var activebox_position = check_box_position(message_group_id);	
			if (activebox_position=="left")
				{
					$(".im_left").change_status_active("bord","active");
				}
			else if (activebox_position=="right")
				{
					$(".im_right").change_status_active("bord","active");
				}						
	}
	
	function check_box_position(message_group_id)
	{
		var check_index = $("#chat_windows"+message_group_id).index();
		if (current_index - check_index < 0)
		{return("left");}
		else if(current_index - check_index >= n_chatbox)
		{return("right");}
		else
		{return("center");}
	}

function checkMessage()
{
	$.get(CONTROLLER_URL+"Im/LoadCheckMessage", function(html)
	{
		
		if(html)
		{
			var tst=eval("("+html+")"); 
			var message_group_id = tst.message_json[0].message_group_id;
			var type = tst.message_json[0].type;
			if(!newmessage_session.in_array(message_group_id))
				{
					newmessage_session.push(message_group_id);
					var item_stat = check_status_chatwindows(message_group_id);
					//alert(item_stat);
					//commence switch
					switch(item_stat)
					{	
						case "li_chat_windows_open_active":
							GetNoreadMessage(tst.message_json[0].message_group_id,tst.message_json[0].last_message_id);
						break
						case "li_chat_windows_open_noactive": 
							GetNoreadMessage(tst.message_json[0].message_group_id,tst.message_json[0].last_message_id);
							$("#chat_windows"+message_group_id).change_status_active("child","active");
							change_leftright_active(message_group_id);
						break
						case "li_chat_windows_close": 
						$.get(CONTROLLER_URL+"im/LoadWindowsChater&message_group_id="+message_group_id, function(result)
							{
								//$(".li_chat_windows_open_active").addClass("li_chat_windows_open_noactive").removeClass("li_chat_windows_open_active");
								$(".ul_im_content_chat").append(result);
								
								GetNoreadMessage(tst.message_json[0].message_group_id,tst.message_json[0].last_message_id);
								
								$("#chat_windows"+message_group_id).change_status_active("child","active");
								$("#chat_windows"+message_group_id).change_status_active("self","noactive");
								if (sum>=n_chatbox)
										{
											left_index = left_index+1;
											initializing_left_right();
										}
								//read noread....		
								/*		
								var last_message_id = $("#ul_chatlist"+chat_session+" li:last-child").attr("item_id");
								var data_message = {};
								data_message["last_message_id"] = last_message_id;
								data_message["chat_session"] = chat_session;
								$.post(CONTROLLER_URL+"im/updateLastMessage_id",data_message,function(html){});
								*/
								newmessage_session.remove(message_group_id);
								
								});
							sum++;	
						break
					}
				//finir switch
				}
		} 
	});
	
	setTimeout(checkMessage, 1000 );
}

function GetNoreadMessage(message_group_id,last_message_id)
{
$.get(CONTROLLER_URL+"im/GetNoreadMessage&message_group_id="+message_group_id+"&last_message_id="+last_message_id,function(result)
									{		
											$("#ul_chatlist"+message_group_id).append(result);
											scrolldown(message_group_id);
											newmessage_session.remove(message_group_id);
									});
}

function update_message_group(message_group_id,friend_id)
{
$.get(CONTROLLER_URL+"im/Update_Message_Group&message_group_id="+message_group_id+"&friend_id="+friend_id,function(result)
									{		
											//alert(result);
									});
}

function refresh_group(message_group_id)
{
$.get(CONTROLLER_URL+"im/RefreshGroup&message_group_id="+message_group_id,function(result)
									{		
											//alert(result);
											
											
											$("#chat_windows"+message_group_id+" span.chatmembers").html(result);
									});
}
function leave_chatgroup(message_group_id)
{
$.get(CONTROLLER_URL+"im/LeaveChatGroup&message_group_id="+message_group_id,function(result)
									{		
											closeChatWindows(message_group_id);										
									});
}
	
	
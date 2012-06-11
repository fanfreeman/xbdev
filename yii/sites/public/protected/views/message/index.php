<?php $this->widget('CommonHeader',array('current_page'=>'message')); ?>
<!--  S=messageMain  -->
<div id="messageMain">
    <!--  S=messageUserList-->
    <article id="messageUserList" class="fl">
    	<!--  S=messageSearchFrame  -->
        <section id="messageSearchFrame" class="fl">
        	<div class="addMessage fl"></div>
            <div class="SearchBox fl">
            	<input type="text" class="SearchText fl chatwithwho" placeholder="Find someone" />
                <input type="button" class="SearchBtn fr" value="" />
            </div>
        </section><!--  E=messageSearchFrame  -->
        <!--  S=UserList-->
        <ul class="userList">
        	<!--  S=添加新人聊天  -->
        	<li id="newMessage" style="display:none;">
                <a href="#" target="_blank" title="Chen Pengfei"><img src="images/peoplePic01.png" class="userPhoto fl" alt="" /></a>
                <aside class="fl">
                    <h6>New message to : <span id="messageTo"></span></h6>
                </aside>
                <div class="ClearBoth"></div>
            </li>    
            <!--  E=添加新人聊天  -->  
            <!--  S=循环体  -->
        	<?php $this->renderPartial('listgroup',array('datatest'=>$datatest));?>
            <!--            <li class="online">
            	<span class="ball"></span><span class="tips">2</span>
                <a href="#" target="_blank" title="Chen Pengfei"><img src="images/peoplePic02.png" class="userPhoto fl" alt="" /></a>
                <aside class="fl">
                    <h6 class="Rows"><a href="#" target="_blank" title="Chen Pengfei">Chen Pengfei,freeman fan,lei.han,xu chen</a></h6>
                    <p class="Rows">hdhshdsadhjshdsammhdhshdsadhjshdsammhdhshdsadhjshdsamm</p>
                </aside>
                <div class="ClearBoth"></div>
            </li>   --> 
            <!--  E=循环体  -->     
              
        </ul><!--  E=UserList -->
    </article><!--  E=messageUserList -->
    <!--  S=InformationRecorded -->
    <article id="informationRecorded" class="fl">
    </article><!--  E=InformationRecorded -->
</div><!--  E=messageMain  -->
<script type="text/javascript" src="/js/jQuery/message.js"></script>
<script>
<?php
if (isset($_GET["message_group_id"]))
{
?>
$('.userList li#li_chatgroup_<?php echo $_GET["message_group_id"];?>').click();
<?php
}
else
{
?>
$('.userList li.li_chatgroup:first').click();
<?php
}
?>


var array_allmembers = new Array();
var array_message_group_ids = new Array();
//数组删除该值的元素
Array.prototype.remove = function(obj)
{for ( var i=0 ; i < this.length ; ++i ){if ( this[i] == obj ){if ( i > this.length/2 ){for ( var j=i ; j < this.length-1 ; ++j ){this[j] = this[j+1];}this.pop();}else{for ( var j=i ; j > 0 ; --j ){this[j] = this[j-1];}this.shift();}break;}}}
//判断数组是否有与该值相同的元素
Array.prototype.in_array = function(e){for(i=0;i<this.length && this[i]!=e;i++);return !(i==this.length);}


function messageAjax(function_for,type,url,data){
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
					switch (function_for){
					case "loadAtomMessages" :
						$('#informationRecorded').html(json.html); 
						//从数组中删除
						array_allmembers.remove(data.all_members);
						//调整左侧userlist高度
						$("#messageUserList ul.userList").atomPageAuto({ type : "height", num : 89 });
						//调整右侧informationRecorded宽度
						$("#informationRecorded").atomPageAuto({ type : "width", num : 239 });
						//调整右侧senderShow宽度	
						$("#senderFrame ul.senderShow").atomPageAuto({ type : "width", num : 410 }); 
						//调整右侧messagelist高度
						$("#informationRecorded ul.messageList").setMessageListHeight();
						//调整右侧sendMessage宽度
						$("#sendMessageFrame .sendText").atomPageAuto({ type : "width", num : 375 });
						$("#sendMessageFrame .sendText").focus();
						//滚动条
						$("#informationRecorded ul.messageList").scrollTop(1000000);
						//newmessage消失
						if($("#newMessage").is(":visible"))
							{
								$("#newMessage").slideUp();
							}
						//去掉在线绿点
						$('#li_chatgroup_'+data.message_group_id).removeClass("online");	
					break;
					case "SendMessage" :
						$(".messageList").append(json.html);
						$(".sendText").val('');
						$("#informationRecorded ul.messageList").scrollTop(1000000);
						refresh_last_message(data.message_group_id,json.last_message_sended);
						move_to_top(data.message_group_id);
					break;
					case "CreatMessages" :
						$('#informationRecorded').html(json.html); 
						//调整左侧userlist高度
						$("#messageUserList ul.userList").atomPageAuto({ type : "height", num : 89 });
						//调整右侧informationRecorded宽度
						$("#informationRecorded").atomPageAuto({ type : "width", num : 239 });
						//调整右侧senderShow宽度	
						$("#senderFrame ul.senderShow").atomPageAuto({ type : "width", num : 410 }); 
						//调整右侧messagelist高度
						$("#informationRecorded ul.messageList").setMessageListHeight();
						//调整右侧sendMessage宽度
						$("#sendMessageFrame .sendText").atomPageAuto({ type : "width", num : 375 });
						$("#senderFrame .addPeopleText").focus();
					break;
					case "SendNewMessage" :
						if($('#li_chatgroup_'+json.message_group_id).length)
						{
							$('#li_chatgroup_'+json.message_group_id).click();
							refresh_last_message(json.message_group_id,json.last_message_sended);
						}
						else
						{
							messageAjax('LoadNewMessageGroup','get',"<?php echo Yii::app()->createUrl('Message/LoadNewMessageGroup');?>",{message_group_id : json.message_group_id});
						}
					break;
					case "LoadNewMessageGroup" :
						$(json.html).insertAfter('#newMessage');
						$('#li_chatgroup_'+data.message_group_id).click();
					break;
					case "GetNoreadMessage" :
						$('.messageList').append(json.html);
						$("#informationRecorded ul.messageList").scrollTop(1000000);
					break;
					case "refreshMessageGroupList":
						//alert(json.html);
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
	
$('.addMessage').click(function(){
	messageAjax('CreatMessages','get',"<?php echo Yii::app()->createUrl('Message/CreatMessages');?>",'');
});

/*
$('.chatwithwho').bind('keyup', function(event){
	var textSearch = $(this).val();
	messageAjax('refreshMessageGroupList','get',"<?php //echo Yii::app()->createUrl('Message/refreshMessageGroupList');?>",{textSearch : textSearch});
//$('.userList').html(result);
//});
});
*/

checkMessages();
</script>

	<section id="senderFrame" class="senderFrame fl">
        <div class="sendToTitle fl">To:</div>
        <ul class="senderShow fl">
           <!-- <li class="name">
                <p class="fl">chen pengfei</p>
                <a href="#" class="deleteName fr" title="delete chen pengfri"></a>
            </li>-->
            <li id="peopleText">
                <input type="text" class="addPeopleText" placeholder="Write your firend name" />
                <ul class="completionUserList">
                    <!--<li class="imQuickLi" name="chen pengfei" nameID="01">
                        <img src="images/peoplePic01.png" class="userPhoto fl" alt="chen pengfei" />
                        <p class="userName fl">chen pengfei</p>
                    </li>
                    <li class="imQuickLi" name="freeman fan" nameID="02">
                        <img src="images/peoplePic01.png" class="userPhoto fl" alt="freeman fan" />
                        <p class="userName fl">freeman fan</p>
                    </li>-->
                </ul>
                <input  class="hiddenPeople"  type="hidden" value="" />
            </li>
        </ul>
        <!--  S=messageOperation [delete] [addPeople] -->
        <div id="messageOperation" class="fr">
            <!--<input type="button" class="deleteBtn fr" value="" />
            <input type="button" class="addBtn fr" value="" />-->
        </div><!--  E=messageOperation [delete] [addPeople]  -->
    </section>
    <ul class="messageList">
    </ul>
    <section id="sendMessageFrame">
        <textarea class="sendText"></textarea>
        <input type="button" class="sendNewBtn" value="" />
    </section>
<script>
	
	$("#senderFrame ul.senderShow").atomPageAuto({ type : "width", num : 460 }); 
		//添加新聊天
	$("#messageSearchFrame div.addMessage").atomMessageCreatMessages();

	//输入发送人text
	$("#peopleText .addPeopleText").bind("keyup", function(event){
		var oThis = $(this);
		var oNameList = $(this).next("ul.completionUserList"); 
		var str_search = $(this).val();
		var keys = {
			enter:  13,
			escape: 27,
			up:     38,
			down:   40,
			array:  [13, 27, 38, 40]
		}
		//oNameList.show();
		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
		if($.inArray(keyCode, keys.array) !=-1){
			switch (keyCode){
				case keys.up:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").prev().addClass("selected").siblings().removeClass("selected");
						}else{
							oNameList.children().eq("0").addClass("selected");
						}
					}
				break;
				case keys.down:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").next().addClass("selected").siblings().removeClass("selected");
						}else{
							oNameList.children().eq("0").addClass("selected");
						}
					}else{
						//getCompletionUserList(str_search, oNameList,{$message_group_id});
					}
				break;
				case keys.enter:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").click();
						}else{
							oNameList.children("li").eq(0).click();
						}
					}
					//if(oThis.val() != ""){
						//韩磊在这里执行加人操作，成功后执行下面代码
						//if (oThis.attr("nameID"))
						//{
							//var friend_id = oThis.attr("nameID");
							
							//oThis.attr("nameID","");
						//}
					//}
				break;
				default :
				break;
			}
		}else{
			if(str_search!=""){
				//alert(str_search);
				getCompletionUserList(str_search, oNameList);
			}
		}
	});
	//输入发送人text退格键操作，只能绑定keydown
	$(".addPeopleText").bind('keydown', function(event){
		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
		var oThis = $(this);
		var oNameList = $("ul.completionUserList"); 
		if(keyCode == 8) {
			if(oThis.val() === ""){
				if(oNameList.is(":visible")){ oNameList.hide(); }
				if(oThis.parent("li").prevAll("li.name").length > 0){
					oThis.parent("li").prev(".name").find(".deleteName").click();
				}
			}
		}
	});

//读取user列表
function getCompletionUserList(str, listObj){
	//alert("js-ok");
	var str_has_id = $('.hiddenPeople').val();
	var oWrap = listObj.prevAll(".addPeopleShow");
	listObj.css("top", oWrap.outerHeight(true));
	$.ajax({
		type : 'get',
		url : "<?php echo Yii::app()->createUrl('Message/GetAddFriendList');?>",
		data : {str_search : str , str_has_id : str_has_id},
		dataType : "json",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			if(json.success)
			{
				if (json.html !=""){
					if(listObj.is(":hidden")) { listObj.show(); }
					listObj.show();
					listObj.html("");
					listObj.append(json.html);
				}else{
					if(listObj.is(":visible")) { listObj.hide(); }
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
$(".sendNewBtn").click(function(){
	var str_otherMembers = $('.hiddenPeople').val();
	sendtext = $('.sendText').val();
	if (sendtext.length>0&&str_otherMembers!='')
		{ 
		messageAjax('SendNewMessage','post',"<?php echo Yii::app()->createUrl('Message/SendNewMessage');?>",{message_sended : sendtext,str_otherMembers : str_otherMembers});
		}
});

$('.sendText').bind('keyup', function(event){
	if (event.keyCode=="13"){
		$('.sendNewBtn').click();
		$('.sendText').val('');
		}
	});
	
</script>
	<section id="imBlock<?php echo $message_group_id;?>" class="imMessageBlock" alt="win">
	<header>
	<h6 class="on fl Rows chater_name"><?php echo $str_users_name;?></h6>
	<span class="fr closeIM">X</span>
	</header>
	<div class="scaleBlock">
	<ul class="operationsList">
	<li><a href="#" class="AddPeople" title="Add People"></a></li>
	<li><a href="<?php echo Yii::app()->createUrl('message/index',array('message_group_id'=>$message_group_id));?>" class="ShowMessage" title="Show Messages"></a></li>
	<li class="ExitIM"><a href="#" class="ExitIM" title="Exit IM"></a></li>
	</ul>
	<div class="addPeopleBlock fl pr">
    	<ul class="addPeopleShow fl">
        	<li><input type="text" class="addPeopleText" id="addPeopleText<?php echo $message_group_id;?>" size="1" placeholder="Enter a colleage's name" /></li>
        </ul>
        <input type="hidden" id="hiddenPeople<?php echo $message_group_id;?>" class="hiddenPeople" value="" />
    	<input type="button" class="addPeopleBtn fr" id="addPeopleBtn<?php echo $message_group_id;?>" value="ADD"/>
        <ul class="completionUserList" id="completionUserList<?php echo $message_group_id;?>"></ul>
    </div>
    <ul class="messageList" id="ul_chatlist<?php echo $message_group_id;?>">
    <?php
 	$this->renderPartial('messages',array('dataMessages'=>$dataMessages));
        ?>
    </ul>
	<div class="messageSend">
	<textarea class="sendText message_sended" item_id="<?php echo $message_group_id;?>"></textarea>
	</div>
	</div>
	</section>


<script>
		hWin += "<section class=\"imMessageBlock fr imMessageBlock<?php echo $message_group_id;?>\" alt=\"imBlock<?php echo $message_group_id;?>\" item_id=\"<?php echo $message_group_id;?>\">";
		hWin += "<header>";
		hWin += "<h6 class=\"off fl Rows chater_name\"><?php echo $str_users_name;?></h6>";
		hWin += "<span class=\"fr closeIM\">X</span>";
		hWin += "</header>";
		hWin += "</section>";
		$(hWin).appendTo("#imMessageList");
		var nWidth = 0;
		for(var i = 0; i< $("#imMessageList").children().length; i++){
			nWidth = nWidth + $("#imMessageList").children().outerWidth(true);
		}
		$("#imMessageList").width(nWidth);
		IMShow();
		IMBtn();
	$(".messageList").scroll(function(e){
		e.preventDefault();
	});	
	$('#addPeopleText<?php echo $message_group_id;?>').bind('keydown', function(event){
		var keyCode = event.keyCode ? event.keyCode : event.which ? e.which : event.charCode;
		var oThis = $(this);
		var oNameList = $("ul#completionUserList<?php echo $message_group_id;?>"); 
		if(keyCode == 8) {
			if(oThis.val() === ""){
				if(oNameList.is(":visible")){ oNameList.hide(); }
				if(oThis.parent("li").prevAll().length > 0){
					oThis.parent("li").prev(".name").find(".deleteName").click();
				}
			}
		}
	});
	$('#addPeopleText<?php echo $message_group_id;?>').bind('keyup', function(event){
		var oThis = $(this);
		//var oNameList = oThis.next("ul.completionUserList"); 
		//event.preventDefault();
		var oNameList = $("ul#completionUserList<?php echo $message_group_id;?>"); 
		var str_search = $(this).val();
		var keys = {
			enter:  13,
			escape: 27,
			up:     38,
			down:   40,
			array:  [13, 27, 38, 40]
		}
		var iCount = oThis.val().replace(/[^\u0000-\u00ff]/g,"aa");
		oThis.attr("size", iCount.length > 33?33:iCount.length + 1);
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
						getCompletionUserList(str_search, oNameList,<?php echo $message_group_id;?>);
					}
				break;
				case keys.enter:
					if(oNameList.is(":visible")){
						if (oNameList.children().hasClass("selected")){
							oNameList.children(".selected").click();
						}else{
							oNameList.children("li").eq(0).click();
						}
						oNameList.slideUp("fast");
					}
					//if(oThis.val() != ""){
						//韩磊在这里执行加人操作，成功后执行下面代码
						//if (oThis.attr("nameID"))
						//{
							//var friend_id = oThis.attr("nameID");
							oThis.val("");
							//oThis.attr("nameID","");
							oThis.parent(".addPeopleBlock").slideUp();
						//}
					//}
					
				break;
	//			case keys.escape:
//					if(oNameList.is(":visible")){
//						if (oNameList.children().hasClass("selected")){
//							oNameList.children(".selected").click();
//						}else{
//							oNameList.children("li").eq(0).click();
//						}
//						oNameList.slideUp("fast");
//					}
				break;
				default :
				break;
			}
		}else{
			getCompletionUserList(str_search, oNameList,<?php echo $message_group_id;?>);
		}
	   });
	$("#addPeopleBtn<?php echo $message_group_id;?>").live("click", function(){
		var message_group_id = '<?php echo $message_group_id;?>';
		var friend_id = $('#hiddenPeople'+message_group_id).val();
		if (friend_id!='')
		{
			create_message_group(message_group_id,friend_id);
		}
		oText = $('#addPeopleText<?php echo $message_group_id;?>');
		oText.val("");
		$('#hiddenPeople<?php echo $message_group_id;?>').val('');
		oText.parent("li").prevAll(".name").find(".deleteName").click();
		oText.parents(".addPeopleBlock").slideUp();
		});
	
	//快速补全userNameList
	$("li.imQuickLi").live("click", function(){
		//alert("js-ok");
		var oThis = $(this);
		var oList = oThis.parent("ul.completionUserList").prevAll(".addPeopleShow");
		var oHidden = oThis.parent("ul.completionUserList").prevAll(".hiddenPeople");
		var oText = oList.find(".addPeopleText");
		var html = "<li class=\"name\"><p class=\"fl\">" + oThis.attr("name") + "</p><a href=\"#\" class=\"deleteName fr\" title=\"delete " + oThis.attr("name") + "\" nameID=\"" + oThis.attr("nameID") + "\"></a></li>";
		$(html).insertBefore(oText.parent("li"));		
		oHidden.val(oHidden.val() + oThis.attr("nameID") + "_");
		oText.val("");
		oThis.parent("ul.completionUserList").hide().html("");
		oText.focus();
	});
	//删除已选中user列表中的user
	$('#imBlock<?php echo $message_group_id;?>').find(".deleteName").live("click", function(e){
		e.preventDefault();		
		var oThis = $(this);
		var oHidden = oThis.parents("ul.addPeopleShow").next(".hiddenPeople");
		var nameID = oHidden.val().replace((oThis.attr("nameID") + "_"),"");
		oHidden.val(nameID);
		oThis.parent("li.name").remove();
	});

//读取user列表
function getCompletionUserList(str, listObj,message_group_id){
	//alert("js-ok");
	var oWrap = listObj.prevAll(".addPeopleShow");
	listObj.css("top", oWrap.outerHeight(true));
	$.ajax({
		type : 'get',
		url : "/Im/GetAddFriendList",
		data : {str_search : str , message_group_id : message_group_id},
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
  
  $('.message_sended').bind('keyup', function(event){
	  var oThis = $(this);
	  event.preventDefault();
		if (event.keyCode=="13")
		{
			if (oThis.val().length>1)
				{ 
				imAjax('SendMessage','post',"/Im/SendMessage",{message_sended : $(this).val(),message_group_id : $(this).attr('item_id')});
				oThis.val("");//清除输入框内容
				oThis.height("26");
			}
		}
	}); 		
	//点击显示添加people的input
	$(".AddPeople").live("click",function(e){
		e.stopPropagation();
		e.preventDefault();
		var oaddPeopleBlock = $(this).parents(".scaleBlock").find(".addPeopleBlock");
		if(oaddPeopleBlock.is(":hidden")){
			oaddPeopleBlock.slideDown("fast");	
			oaddPeopleBlock.find(".addPeopleText").focus();
		}
	});
	//点击退出群组聊天
	$(".ExitIM").live("click",function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).parents('.operationsList').parents('.scaleBlock').parents('.imMessageBlock').find('span.closeIM').click();
	});
	
	function create_message_group(message_group_id,friend_id)
	{
		imAjax('Create_Message_Group','get',"/Im/Create_Message_Group",{message_group_id : message_group_id , friend_id : friend_id});
	}
</script>

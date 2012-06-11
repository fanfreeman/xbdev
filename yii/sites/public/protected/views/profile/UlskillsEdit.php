<ul id="skillsList">
<?php
$this->renderPartial('skillsEdit',array('user_skills'=>$user_skills));	
?>

<li id="skillsText">
	<input type="text" class="addSkillsText" placeholder="Write your skills" maxlength="100" />
		<!--<ul class="completionUserList">
			<li class="imQuickLi" name="chen pengfei" nameID="01">
			skills name
			</li>
			<li class="imQuickLi" name="freeman fan" nameID="02">
			skills name
			</li>
		</ul>
	<input type="hidden" class="hiddenPeople" value="" />-->
</li>
<li id="skillsEdit"></li>
<div class="ClearBoth"></div>
</ul>
<script>
	$('#skillsEdit').bind('click', function(event){
	  var oThis = $(this);
	  oThis.hide();
	  oThis.prev().show().children("input.addSkillsText").focus();
	}); 
  $('.addSkillsText').bind('keyup', function(event){
	  var oThis = $(this);
	  event.preventDefault();
		if (event.keyCode=="13")
		{
			if (oThis.val().length>0)
				{
					oThis.parent().hide();
				oThis.parent().next().show();
				skillAjax('updateUserSkill','post','/Profile/updateUserSkill',{skill : oThis.val()});
				}
		}
	}); 
	
	$("#skillsList").find(".deleteName").live("click", function(e){
		e.preventDefault();		
		var oThis = $(this);
		var user_skill_id = $(this).attr('item_id');
		skillAjax('delUserSkill','post','/Profile/delUserSkill',{user_skill_id : user_skill_id});
		//oThis.parent("li").remove();
	});

function skillAjax(function_for,type,url,data){
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
					case "updateUserSkill" :
						if(json.addSkill)
							{
								$(json.html).insertBefore('#skillsText');
							}
							$('.addSkillsText').val("");//清除输入框内容
					break;
					case "delUserSkill" :
						$("#skillsList").find("#skillsList_li_"+data.user_skill_id).remove();
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
</script>
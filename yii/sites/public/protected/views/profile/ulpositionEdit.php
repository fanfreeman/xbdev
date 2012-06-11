<?php
$this->renderPartial('positionEdit',array('user_positions'=>$user_positions));
?>
<li id="positionText">
    <input type="text" class="addPositionText" placeholder="Write your position name" />
    <input id="position_father_id" value="<?php echo $position_info['father_id'];?>"  type="hidden" />
     <input id="position_tree_id" value="<?php echo $position_info['tree_id'];?>" type="hidden" />
      <input id="position_tree_level" value="<?php echo $position_info['tree_level'];?>"  type="hidden" />
</li>
<li id="positionEdit">+</li>
<div class="ClearBoth"></div>
<script>
$('#positionEdit').bind('click', function(event){
	  var oThis = $(this);
	  oThis.hide();
	  oThis.prev().show().children("input.addPositionText").focus();
	}); 
 $('.addPositionText').bind('keyup', function(event){
	  var oThis = $(this);
	  event.preventDefault();
		if (event.keyCode=="13")
		{
			if (oThis.val().length>0)
				{
				oThis.parent().hide();
				oThis.parent().next().show();
				var father_id = $('#position_father_id').val();
				var tree_id = $('#position_tree_id').val();
				var tree_level = $('#position_tree_level').val();
				positionAjax('updateUserPosition','post','/Profile/updateUserPosition',{position : oThis.val(),father_id : father_id,tree_id:tree_id,tree_level:tree_level});
				}
		}
	}); 
	
	$(".positionList").find(".deleteName").live("click", function(e){
		e.preventDefault();		
		var oThis = $(this);
		var father_id = $(this).attr('item_id');
		positionAjax('delUserPosition','post','/Profile/delUserPosition',{father_id : father_id});
		//oThis.parent("li").remove();
	});
	
	function positionAjax(function_for,type,url,data){
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
						case "updateUserPosition" :
							$('#position_father_id').val(json.group_id);
							$('#position_tree_id').val(json.tree_id);
							$('#position_tree_level').val(json.tree_level);
							$(json.html).insertBefore('#positionText');
							$('.addPositionText').val("");//清除输入框内容
						break;
						case "delUserPosition" :
							$("#positionText").prevUntil("#li_user_position_father_id_"+data.father_id).remove();
							$("#li_user_position_father_id_"+data.father_id).remove();
							$('#position_father_id').val(json.group_id);
							$('#position_tree_id').val(json.tree_id);
							$('#position_tree_level').val(json.tree_level);
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
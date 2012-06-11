<h2>每日一句</h2>
<div id="q">
 <?php $this->renderPartial('_quote', array('quote' => $quote,))?> 
</div>
<?php echo CHtml::ajaxLink('Next', array('getQuote'),array('update' => '#q'))?>
<h1>About Excel</h1>
<form name="frmBatchSettle"  action="http://atom.com/test/ex" method="post" enctype="multipart/form-data">  
                   <input type="file" name="batchFile" value="">  
                   <input type="submit" value="上传">  
</form> 
<?php ?>
<h1 id="userName" class="userName editInfor">
    <label for="userNameText" class="info">
    	<p>UserName:</p><span class="edit"></span></label>
    <input type="text" id="userNameText" class="text" alt="userSignature" />
</h1>
<script>
$("#userName").find(".info").bind('click', function(event){
 	  var oThis = $(this);
 	  oThis.hide();
	  $('#userNameText').show().focus();
 	}); 

$('#userNameText').bind('keyup', function(event){
	  var oThis = $(this);
	  event.preventDefault();
		if (event.keyCode=="13")
		{
			if (oThis.val().length>0)
				{
					oThis.hide();
				    userNameAjax('firstname','POST','/Profile/updateUserInfo',{columType : "user_name" , columVal : oThis.val()});
				}
		}
	}); 

function userNameAjax(function_for,type,url,data){
	
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
					    $("#userName").find(".info").html(json.html + "<span class=\"edit\"></span>").show();
						$('#userNameText').val("");					
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
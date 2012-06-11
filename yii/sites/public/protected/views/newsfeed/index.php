<?php $this->widget('CommonHeader',array('current_page'=>'newsfeed')); ?>
<!--  S=newsfeedHead  -->
<header id="newsfeedHead">
    <!--  S=newsfeedHead  -->
    <section id="newsfeedSearchFrame" class="fl">
        <div class="SearchBox fl">
            <input type="text" class="SearchText fl newsfeedSearchText" placeholder="" />
            <input type="button" class="SearchBtn fr" value="" />
        </div>
    </section><!--  E=newsfeedSearchFrame  -->
</header>
<!--  E=fileHead  -->
<!--  S=newsfeedUserList-->
<article id="newsfeedUserList" class="fl">
	<section id="GroupsTitle">Grounps</section>
    <!--  S=UserList-->
   <ul class="userList">
       <!-- <li>
        	<span class="grounpsIcon"></span><span class="triangle"></span>
            <aside class="fl">
                <h6 class="Rows">all newsfeed</h6>
                <p class="Rows">1041 people</p>
            </aside>
            <div class="ClearBoth"></div>
        </li>    
        <li>
        	<span class="grounpsIcon"></span><span class="triangle"></span>
            <aside class="fl">
                <h6 class="Rows">test grounps</h6>
                <p class="Rows">10 people</p>
            </aside>
            <div class="ClearBoth"></div>
        </li> --> 
    </ul><!--  E=UserList -->
    
    
</article><!--  E=newsfeedUserList -->
<!--  S=newsfeedMain -->
<article id="newsfeedMain">
	<!--  S=postNewsfeed -->
	<section id="postNewsfeedFrame">
    	<header>Post Stream</header>
        <img src="<?php echo Yii::app()->user->avatar;?>" class="userPhoto fl" alt="<?php echo CHtml::encode(Yii::app()->user->firstname).'&nbsp;'.CHtml::encode(Yii::app()->user->lastname);?>" />
        <textarea class="sendText fr" id="text_newsfeed"></textarea>
    </section><!--  S=postNewsfeed -->
    <!--  S=newsfeedList -->
       <section id="newsfeedList">
		<?php
       $this->renderPartial('newsfeeds',array('dataNewsfeeds'=>$dataNewsfeeds));
       ?>       
       </section>  
    <!--  S=newsfeedList -->
</article>
<!--  E=newsfeedMain  -->
<script type="text/javascript" src="/js/jQuery/newsfeed.js"></script>
<script>
//页面到底部，获取最后一个newsfeed id，触发读取newsfeed动作
$(window).scroll(function() {
  if ($(this).height()+$(this).scrollTop() >= $(document).height()) {
	 // alert('gooddd');
	var since_newsfeed_id = $('#newsfeedList>article:last-child').attr("item_id");
	newsfeedAjax('LoadNewsfeedSince','get',"<?php echo Yii::app()->createUrl('newsfeed/LoadNewsfeedSince');?>",{since_newsfeed_id : since_newsfeed_id});
	//loadContent("scroll_load",newsfeed_id);
  }
});

//newsfeed list click
function openComment(newsfeed_id)
{
	$('.addNewsfeedcom_'+newsfeed_id).parent("header.less").attr("class", "more").next("section.comment").slideDown("fast",function(){
		newsfeedAjax('LoadComments','get',"<?php echo Yii::app()->createUrl('FeedComments/LoadComments');?>",{newsfeed_id : newsfeed_id});
		});
		
}
function closeComment(newsfeed_id)
{
	$('.closenewsfeedcom_'+newsfeed_id).parent("header.more").attr("class", "less").next("section.comment").slideUp("fast");
}
function sendNewsfeedCommend(newsfeed_id)
{
	var comment_content = $(".sendCommendText_"+newsfeed_id).val();
	if (comment_content.length>1)
	{
		newsfeedAjax('SendComment','get',"<?php echo Yii::app()->createUrl('FeedComments/SendComment');?>",{newsfeed_id : newsfeed_id,comment_content : comment_content});
	}
}
//open comment
/*
$("#newsfeedList").children(".newsfeed").children("header.less").children(".title").click(function(){
	$(this).parent("header.less").attr("class", "more").next("section.comment").slideDown("fast",function(){
		newsfeedAjax('LoadComments','get',"index.php?r=FeedComments/LoadComments",{newsfeed_id : $(this).attr('item_id')});
		});
});
*/
//close comment
/*
$("#newsfeedList").children(".newsfeed").children("header").children(".tips").live('click',function(){
	//alert(8);
	$(this).parent("header.more").attr("class", "less").next("section.comment").slideUp("fast");
});
*/
//发评论
/*
$('.sendBtn').click(function(){
	var newsfeed_id = $(this).attr('item_id');
	var comment_content = $(this).parent(".sendBox").children(".sendText").val();
	if (comment_content.length>1)
	{
		newsfeedAjax('SendComment','get',"index.php?r=FeedComments/SendComment",{newsfeed_id : newsfeed_id,comment_content : comment_content});
	}
})
*/
$('#text_newsfeed').bind('keyup', function(event){
	var oThis = $(this);
	event.preventDefault();
	if (event.keyCode=="13")
	{
		if (oThis.val().length>1)
		{
			newsfeedAjax('SendNewsfeed','get',"<?php echo Yii::app()->createUrl('newsfeed/SendNewsfeed');?>",{newsfeed_content : oThis.val()});
		}
	}
}); 

$('.newsfeedSearchText').bind('keyup', function(event){
	event.preventDefault();
	//if($(this).val().length>0)
	{
		newsfeedAjax('SearchNewsfeed','get',"<?php echo Yii::app()->createUrl('newsfeed/SearchNewsfeed');?>",{newsfeedSearchText : $(this).val()});
	}
}); 
function newsfeedAjax(function_for,type,url,data){
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
					case "SendNewsfeed" :
						$('#text_newsfeed').val('');
						//$(json.html).insertBefore($("#newsfeedList"));
						$("#newsfeedList").prepend(json.html);
					
					break;
					case "LoadComments" :
                        $('#commentList_'+data.newsfeed_id).empty();
						$('#commentList_'+data.newsfeed_id).append(json.html);
					break;
					case "SendComment" :
						$('#commentList_'+data.newsfeed_id).append(json.html);
						$('.sendCommendText_'+data.newsfeed_id).val('');
						//刷新评论个数
						$('.addNewsfeedcom_'+data.newsfeed_id).html(json.strfeedcomments);
					break;
					case "SearchNewsfeed" :
						//$('#newsfeedList').empty();
						$('#newsfeedList').html(json.html);
						//$('#newsfeedList').insertAfter(json.html);
						//$(json.html).appendto('#newsfeedList');
						//alert(json.html);
					break;
					case "LoadNewsfeedSince" :
						$('#newsfeedList').append(json.html);
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

      
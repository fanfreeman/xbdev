//定义局部变量
var CONTROLLER_URL = "/index.php?r="; 

//ajax读取newsfeed列表，包括首次读取和页面拉到底部后的ajax刷新
function loadContent(load_type,newsfeed_id) {
  $('.newsfeed .tc').show();
	$.get(CONTROLLER_URL+"newsfeeds/LoadNewsFeedListAjax"+"&load_type="+load_type+"&newsfeed_id="+newsfeed_id, function(result){
       if (load_type!="top_load")
		   {
		   $(".newsfeed_list").append(result);
		   }
	   else
	   	  {
			$(".newsfeed_list").prepend(result);  
			$('#newsfeedRemind').hide(); 
			}
		});
  $('.newsfeed .tc').hide();
}

//读取右侧newsfeed详情
function loadNewsFeedDetail(newsfeed_id){
	$.get(CONTROLLER_URL+"newsfeeds/LoadNewsFeedDetailAjax"+"&newsfeed_id="+newsfeed_id, function(result){
        $(".feed_reply").html(result);
		   });
	} 
	
//添加评论
function add_Comments(intFeedId)
{
	var data_comment = {};
	data_comment["intFeedId"] = intFeedId;
	data_comment["feedcomment_content"] = $('#feedcomment_content').val();
	if (data_comment["feedcomment_content"]!="")
		{	//重新读取comment列表
		$.post(CONTROLLER_URL+"newsfeeds/AddComment",data_comment,function(result)
			{
        	$(".feed_reply_list").prepend(result); //读取新添加的评论
			
		 	$('#feedcomment_content').attr("value",""); //删除评论输入框中的内容
			$.post(CONTROLLER_URL+"newsfeeds/ChangeCommentNum",data_comment,function(commentnum)
				{	//重新刷新comment总数
					 $(".li_commentnum_"+data_comment["intFeedId"]).html(commentnum);
				});					
			});
			//添加newsfeed页面回复模块的滚动条
			//addScroll("#feed_reply_scroll","300");
		}
	} 	

 //like 功能  
 function liked(newsfeed_id){
	 var data_like = {};
	 data_like["user_id"] = "<?php echo Yii::app()->user->id ?>";
	 data_like["resource_id"] = newsfeed_id;
	 data_like["resource_type"] = "3";
	 		$.post(CONTROLLER_URL+"Likes/CheckLikes",data_like,function(result)
			{
				switch(result)
				  {
					   case "addlike ok":
						 $('.li_like_'+newsfeed_id).removeClass("notLiked");
						 $('.li_like_'+newsfeed_id).addClass("liked");
						 break;
					   case "dislike ok":
						 $('.li_like_'+newsfeed_id).removeClass("liked");
						 $('.li_like_'+newsfeed_id).addClass("notLiked");
						 break;
					   default:
						 break;
					   }
					$.post(CONTROLLER_URL+"Likes/ChangeLikeNum",data_like,function(likednum)
						{	//重新刷新comment总数
							 $(".li_like_"+data_like["resource_id"]).html(likednum);
						});	
			});
	 }
	 
//读取评论列表	
function list_Comments(intFeedId,id_comment)
{
		$.get(CONTROLLER_URL+"newsfeeds/LoadListCommentsAjax"+"&feedId="+intFeedId+"&id_comment="+id_comment, function(result){
       		 $(".feed_reply_list").append(result);
		 	  });	
	}
//刷新notification功能
function checknotification(){
		//检查是否有新的notification
		$.get(CONTROLLER_URL+"Notifications/LoadCheckNotification", function(num_notification){
			 $('.notification_label').html(num_notification);
		 	  });
		//检查是否有新的newsfeed
	var first_newsfeed_id = $('.newsfeed_list>li:first-child').attr("item_id");
		$.get(CONTROLLER_URL+"newsfeeds/CheckIfHaveNewNewsFeed"+"&first_newsfeed_id="+first_newsfeed_id, function(num){
			 if(num!=0)
			 {
				 if ($('#newsfeedRemind').is(":hidden"))
				 {
					
					$('#newsfeedRemind').show(); 
					 }
				$('#newsfeedRemind>span').html(num); 
				 
				 }
		 	  });
		
		//设置刷新时间为5秒一次
			setTimeout(checknotification, 5000 );
	}
	
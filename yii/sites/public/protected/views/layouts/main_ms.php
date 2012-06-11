<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
	Remove this if you use the .htaccess -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="" />
	<meta name="author" content="xuchen" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <base href="<?php echo Yii::app()->homeUrl ?>" />
	<link rel="stylesheet" type="text/css" href="css/base.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="css/common.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="css/newsfeed.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="css/im.css" media="screen, projection" />
    <script type="text/javascript" charset="utf-8" src="js/jQuery/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jQuery/jQuery.UI.js"></script>
	<script type="text/javascript" src="js/jQuery/UI.js"></script>
    <script type="text/javascript" src="js/jQuery/script.js"></script>
    <script type="text/javascript" src="js/jQuery/jquery.im.js"></script>
	<!–[if lt IE 9]> <script src="js/html5.js"></script>
    <![endif]–>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<head>
<body>
<header class="commonHeader">
	<a href="/index.php?r=message">message测试入口！！！</a>
    <a href="/index.php?r=file">file测试入口！！！</a>
        <label class="userName"><a href="<?php echo CController::createUrl('Profile/Index&uid='.Yii::app()->user->id) ?>"><?php echo Yii::app()->user->firstname.'&nbsp;'.Yii::app()->user->lastname ?></a></label>
        <img src="images/peopleIcon.png" class="userPhoto" alt="Photo" />	
	<!--  S=返回首页  -->
    <a href="#" class="fl returnHome">Return Home</a>
    <!--  E=返回首页  -->
    <div class="fl line"></div>
    <!--  S=搜索  -->
    <div class="search fl">
        <input type="text" class="text fl" value="" placeholder="Search">
        <input type="button" class="btn fl search_btn">
    </div>
    <!--  E=搜索  -->
    <div class="fl line"></div>
    <label class="fl msg notification_label" onClick="notification_flyinto('<?php echo CController::createUrl('Notifications/LoadNotification') ?>')"><?php echo bizNotifications::getNonReadNotification(Yii::app()->user->id) ?></label>
</header>
<!--  E=commonHeader  -->
<!--newsfeed start-->
<article class="newsfeed fl">
	<div class="bottom"><img src="images/NewsfeedListBottom.png" alt="" /></div>
	<header>
    	<!--<div class="fr categoryList" onClick="add_newsfeed()">NewsFeed</div>-->

		<!--  S=列表分类  -->
    	<div class="fr categoryList">NewsFeed
        	<ul class="category">
              <li>NewsFeed</li>
              <li>Liked</li>
              <li>Reply</li>
              <li>Files</li>
            </ul>
        </div>
        <!--  E=列表分类  -->        
        <!--  S=添加Newsfeed按钮  -->
        <img src="images/addNewsFeedBtn.gif" class="fl addNewsfeed" alt="addNewsfeed" />
        <div class="clearBoth"></div>
        <!--  E=添加Newsfeed按钮  -->
	</header>
	<!--  S=PublishBox  -->
        <div class="publishBox">
    		<a href="#"><img src="images/peopleIcon.png" width="50" height="50" alt="name" class="user_photo fl"></a>
        	<div class="InputNormarl">
      			<label class="publishInfo" for="PublishText">@UserName</label>
  	    		<input type="text" id="PublishText" class="publishText newsfeed_params" />
  	  		</div>
        	<div class="addFile fl">+ Add File</div>
        	<input type="button" value="Post" class="btn fr">
    	</div>
    	<!--  E=PublishBox  -->    
<?php echo $content; ?>
	  
	<div class="tc pt10"><img src="images/loading.gif" width="20" height="20" alt="loading"></div>
</article>
<!--newsfeed end-->  
<article class="feed_reply">
<!--read content in by ajax-->  
</article>

<!--popup fixed start-->
<!--<div class="popup_fixed ">Dorthy Wu</div>-->
<!--popup fixed end-->
</body>
<script type="text/javascript" charset="utf-8">
var CONTROLLER_URL = "/index.php?r="; 

//进入页面后，首次读取前20条newsfeed
loadContent("first_load","");

//newsfeed详情关闭功能   //徐晨将这个功能放入UI
$('.feed_reply .close').live('click', function(){
  $('.feed_reply').removeClass("fadeInLeft").addClass("fadeOutLeft").css("opacity","0");
  return false;
});

//点击newsfeed切换css
$('.newsfeed_list li').live('click', function(e){
	//if ($(e.target).is('.liked,.notLiked')) {
		//return false;
	//}
	var newsfeed_id = $(this).attr("item_id");
  $(this).addClass('current').siblings().removeClass('current');
  // get data then replace feed reply then slidedown
  loadNewsFeedDetail(newsfeed_id);
  $('.feed_reply').show().removeClass("fadeOutLeft").addClass("fadeInLeft").css("opacity","1");
});
	
//页面到底部，获取最后一个newsfeed id，触发读取newsfeed动作
$(window).scroll(function() {
  if ($(this).height()+$(this).scrollTop() >= $(document).height()) {
	var newsfeed_id = $('.newsfeed_list>li:last-child').attr("item_id");
	loadContent("scroll_load",newsfeed_id);
  }
});

//添加新newsfeed功能
 $(".publishBox .btn").click(function(){
		//add_newsfeed()；
		var newsfeed_params =  $(".newsfeed_params").val();
		if (newsfeed_params!=null && newsfeed_params!="")
		{	var data_newsfeed = {};
			data_newsfeed["id_user"]="<?php echo Yii::app()->user->id ?>";
			data_newsfeed["intResId"]="1";
			data_newsfeed["strType"]="image";
			data_newsfeed["params"]=newsfeed_params;
			data_newsfeed["first_newsfeed_id"] = $('.newsfeed_list>li:first-child').attr("item_id");
			$.post(CONTROLLER_URL+"newsfeeds/SaveNewsFeedAjax",data_newsfeed,function(result)
				{
				$('#newsfeedRemind').hide(); 	
				$('.newsfeed_list').prepend(result);
				$(".newsfeed_params").val("");
				});
		}
 });
 $("#newsfeedRemind").click(function(){
		var newsfeed_id = $('.newsfeed_list>li:first-child').attr("item_id");
		loadContent("top_load",newsfeed_id);
									  });
   
</script>

</html>

<div id="profilePage" data-role="page" data-add-back-btn="true" data-title="Profile">
  <div data-role="header">
    <h1><a href="directory.html" data-direction="reverse" class="fl">return</a></h1>
  </div>
  <div data-role="content">
  	<img src="/images/peoplePic03.png" class="profileUserPic" alt="user Name" />
  	<h1 class="profileUserName"><?php echo CHtml::encode($user_info['firstname']).' '.CHtml::encode($user_info['lastname']);?></h1>
  	<p class="profileUserSignature clearfix"><?php echo CHtml::encode($user_info['blurb']);?></p>
  	<?php if(!$user_info['edit']){?>
    <a class="button_follow_status" data-role="button" data-inline="true" data-theme="<?php if($user_info['follow_status']){echo "b";}else{echo "c";}?>" item_id="<?php echo $user_info['user_id'];?>"><?php if($user_info['follow_status']){echo "followed";}else{echo "follow";}?></a>
	<a href="index.html" data-role="button" data-inline="true">Send Message</a>
    <?php }?>
  	<ul data-role="listview" data-inset="true">
  		<li data-role="list-divider">Position</li>
  		<?php
		if ($user_positions)
		{
			foreach($user_positions as $user_position)
			{
				echo '<li>'.CHtml::encode($user_position['name']).'</li>';
			}
		}
		?>
  		<li data-role="list-divider">Contact</li>
  		<li><?php echo CHtml::encode($user_info['telephone']);?></li>
  		<li><?php echo CHtml::encode($user_info['mobile']);?></li>
  		<li><?php echo CHtml::encode($user_info['email']);?></li>
  		<li data-role="list-divider">Skills and Expertise</li>
        <?php
        if ($user_skills)
		{
			foreach($user_skills as $user_skill)
			{
				echo '<li>'.CHtml::encode($user_skill['skill']).'</li>';
			}
		}
		?>
  	</ul>
  </div>
</div>
<script>
$('.button_follow_status').click(function(){
	var following_id = $(this).attr('item_id');
	$.ajax({
		type : "get",
		url : "<?php echo Yii::app()->createUrl('/Follows/FollowStatus');?>",
		data : {following_id : following_id},
		dataType : "json",
		cache : true,
		beforSend : function(XMLHttpRequest){
		},
		success : function (json){
			if(json.success)
			{
				if(json.type=='deleteFollow'){
					$('.button_follow_status').attr("data-theme", "c").children().children(".ui-btn-text").text('follow');
				}
				else if (json.type=='addFollow'){$('.button_follow_status').attr("data-theme", "b").children().children(".ui-btn-text").text('followed');}
			}
			else
			{
				console.log(json.error);
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
});
</script>
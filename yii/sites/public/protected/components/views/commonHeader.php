<header class="commonHeader">
	<ul class="nav fl">
    	<li <?php if($current_page=='home') {echo "class='selected'";}?> class="commonHeader_home"><a href="<?php echo Yii::app()->createUrl('/site/desktop');?>" class="home" title="home"></a></li>
    </ul>
    <section id="commonAccount" class="fr">
        <div class="userName fr"><a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$array_user['user_id']));?>" title="<?php echo $array_user['firstname'].'&nbsp;'.$array_user['lastname'];?>"><?php echo $array_user['firstname'].'&nbsp;'.$array_user['lastname'];?></a></div>
       <a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$array_user['user_id']));?>"><img src="<?php echo $array_user['avatar'];?>" class="userPhoto fr user_photo" alt="<?php echo $array_user['firstname'].'&nbsp;'.$array_user['lastname'];?>"></a>
        <div class="myProfile"><a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$array_user['user_id']));?>" title="My Profile">My Profile</a></div>
        <div class="settings"><a title="settings">Settings</a></div>
        <div class="signOut"><a title="sign out">S<em></em>ign out</a></div>
    </section>
</header>
<!--  S=common pop  -->
<article class="commonPop popWindow" id="tipsPop">
	<span class="closePopIcon"></span>
	<header>Settings</header>
    <section class="content">
    	
    </section>
    <ul class="commonPopBtn">
    	<li class="cancel"></li>
        <li class="done"></li>
    </ul>
</article>
<!--  E=settings pop  -->
<script>
/*
function atomRenderAjax(renderPage)
{
	$.ajax({
				type : 'get',
				url : '/index.php?r='+renderPage+'/indexajax',
				data : '',
				dataType : "json",
				cache : true,
				beforSend : function(XMLHttpRequest){
				},
				success : function (json){
					if(json.success)
					{
						$('.commonHeader ul li').removeClass('selected');
						$('.commonHeader ul li.commonHeader_'+renderPage).addClass('selected');
						$('.atom_content').html(json.html);
						
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
*/
function commonHeaderAjax(function_for,type,url,data){
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
					case "settingsPop" :
						$(json.html).insertAfter('.commonHeader');
						$("#settingsPop").atomFly({ type : "fadeIn", zIndex : 101});
					break;
					case "changePassword" :
						if(!json.passstatus)
						{
							alert(json.statusreason);
						}
						else
						{
							$("#settingsPop").atomFly({ type : "fadeOut"});
						}
					break;
					case "signOut":
						window.location.href='index.php';
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
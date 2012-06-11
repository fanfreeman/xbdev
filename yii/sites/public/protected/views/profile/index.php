<?php $this->widget('CommonHeader',array('current_page'=>'directory')); ?>
<!--  S=profileHead  -->
<header id="profileHead">
    <section id="profileReturnDirectory" class="fl"><a href="<?php echo Yii::app()->createUrl('/directory/index');?>" title="return directory"></a></section>
    <aside id="profileStatus" class="fr"><!--online--></aside>
</header>
<!--  E=profileHead  -->

<!--  S=profileMain  -->
<article id="profileMain">
	<!--  S=profileInfoPic  -->
	<section id="profileInfoPic" class="fl">
        <img src="<?php echo $user_info['avatar'];?>" class="userPhoto user_photo" alt="<?php echo CHtml::encode($user_info['firstname']).'&nbsp;'.CHtml::encode($user_info['lastname']);?>" />
        <!--<div class="follow button_follow_status" item_id="<?php //echo $user_info['user_id'];?>"><?php // if ($user_info['follow_status']) {echo "yes";}else{echo "no";}?></div>
        <div class="sendMessage"></div>-->
    </section><!--  E=profileInfoPic  -->
    <!--  S=profileInfo  -->
    <section id="profileInfo" class="fl"> 
		<h1 id="userName" class="userName editInfor">
            <label for="userNameText" class="info">
		    <?php
            if ($user_info['edit'])
		    {
		    	$this->renderPartial('userName',array('user_info'=>$user_info));
			    echo '<span class="edit"></span>';
			}else{
				$this->renderPartial('userName',array('user_info'=>$user_info));}
		    ?> </label>
	        <input type="text" id="userNameText" class="text" alt="user_name" />
        </h1>
        
       <ul class="positionList">
       	<?php
        if ($user_info['edit'])
		{$this->renderPartial('ulpositionEdit',array('user_positions'=>$user_positions,
																	'position_info'=>array('father_id'=>$user_info['father_id'],
																								  'tree_level'=>$user_info['tree_level'],
																								  'tree_id'=>$user_info['tree_id'])));}
		else
		{$this->renderPartial('position',array('user_positions'=>$user_positions));}
		?>
            
        </ul>
        
        <!--
        <aside class="userPosition editInfor">
        	<?php
				// if (($user_info['position']!='')) {
//        		echo '<label for="position" class="info" data-autofill="false">';
//        		echo CHtml::encode($user_info['position']); 
				?>
        	<?php 
//			} else {
//        		echo '<label for="position" class="info" data-autofill="true">';
//        		echo "职位";
//        	} 
			?>
        	<?php
			 //if ($user_info['edit']) {
//        			echo '<span class="edit"></span>';
//        	}
//          	echo '</label>';
           // if ($user_info['edit']){?><input type="text" class="text" alt="position" maxlength="50" onfocus= "this.select()"   onmouseover= "this.select()" />
			<?php
			// }
			?>
        </aside>
        -->
        <div class="ClearBoth"></div>
        <aside class="signature editInfor">
        	<?php if (($user_info['blurb'])!='') {
        		echo '<label for="blurb" class="info" data-autofill="false">';
        		echo CHtml::encode($user_info['blurb']); ?>
        	<?php } else {
        		echo '<label for="blurb" class="info" data-autofill="true">';
        		echo "自我介绍";
        	} ?>
        	<?php if ($user_info['edit']) {
        			echo '<span class="edit"></span>';
        	}
          	echo '</label>';
            if ($user_info['edit']){?><input type="text" class="text" alt="blurb" maxlength="80" onfocus= "this.select()"   onmouseover= "this.select()" /><?php }?>
        </aside>
        <div class="ClearBoth"></div>
        <ul class="btnList">
            <?php if ($user_info['edit']) {?>
            <li id="addFile" style="position: relative; overflow: hidden;cursor: pointer;" class="uploadPhoto"><input id="avatarUpload" type="file" name="file" style="position: absolute; left: -140px; top: 3px; opacity: 0;cursor: pointer;"></li>
            <?php }
			else
			{?>
            <li class="<?php if($user_info['follow_status']){echo "followed";}else{echo "follow";}?> button_follow_status" item_id="<?php echo $user_info['user_id'];?>"></li>
            <?php
			}
			?>
           <?php if (!$user_info['edit']){?>
          	 <li class="sendMessage"></li>
           <?php }?>
        </ul>
    </section>
	<div class="ClearBoth"></div>


    <section id="profileContact">
        <dl>
        	<dt class="userTel"></dt>
            <dd class="editInfor">
            	<?php if (($user_info['telephone']!='')) {
        		echo '<label for="telephone" class="info" data-autofill="false">';
        		echo CHtml::encode($user_info['telephone']); ?>
	        	<?php } else {
	        		echo '<label for="telephone" class="info" data-autofill="true">';
	        		echo "座机";
	        	} ?>
	        	<?php if ($user_info['edit']) {
	        			echo '<span class="edit"></span>';
	        	}
	          	echo '</label>';
	            if ($user_info['edit']){?><input type="text" class="text" alt="telephone" onfocus= "this.select()"   onmouseover= "this.select()" /><?php }?>
            </dd>
        </dl>
        <dl>
        	<dt class="userTel"></dt>
            <dd class="editInfor"><?php    //print_r($user_info); ?>
            	<?php if (($user_info['mobile']!='')) {
        			echo '<label for="mobile" class="info" data-autofill="false">';
        			echo CHtml::encode($user_info['mobile']); ?>
	        	<?php } else {
	        		echo '<label for="mobile" class="info" data-autofill="true">';
	        		echo "手机";
	        	} ?>
	        	<?php if ($user_info['edit']) {
	        			echo '<span class="edit"></span>';
	        	}
	          	echo '</label>';
	            if ($user_info['edit']){?><input type="tel" class="text" alt="mobile" onfocus= "this.select()"   onmouseover= "this.select()" /><?php }?>
            </dd>
        </dl>
        <dl>
        	<dt class="userMail"></dt>
            <dd class="editInfor">
                <label for="fileName01" class="info"><?php echo CHtml::encode($user_info['email']);?><!--<span class="edit"></span>--></label>
               <!-- <input type="text" id="fileName01" class="text" alt="userTel" />-->
            </dd>
        </dl>
    </section><!--  E=profileContact  -->
    <div class="ClearBoth"></div>
    <!--  S=Skills  -->
    <section id="skillsTitle">Skills and Expertise</section>
    	<?php
        if ($user_info['edit'])
		{$this->renderPartial('UlskillsEdit',array('user_skills'=>$user_skills));}
		else
		{$this->renderPartial('skills',array('user_skills'=>$user_skills));}
		?> 
	</article>
<!--  E=profileMain  -->
<!--  S=uploadDocument  -->
<div id="fileList"></div>
<article class="uploadDocument" id="fileTips" style="display:none">
	<header id="fileMain">Upload Document</header>
    <section id="uploadDocument">

	</section>
        <div class="ClearBoth"></div>
        <div id="CloseUploadDocument">Complete</div>
        <div class="ClearBoth"></div>
    
</article>

<!--  E=uploadDocument  -->
<script type="text/javascript" src="/js/jQuery/profile.js"></script>
<script>				
//sendMessage
$("#profileInfo").find(".sendMessage").click(function(){
	$("body").atomPop({
		headerText : "Send Message",
		isTips : false,
		hasCancel : false,
		content : "<div class=\"profileSendMessage\"><textarea id=\"profileSendMessage\"></textarea></div>",
		cancel : function(){
			//send function
				sendtext = $('#profileSendMessage').val().trim();
				if (sendtext.length>0)
					{ 
					messageAjaxtemp('SendNewMessage','post',"<?php echo Yii::app()->createUrl('Message/SendNewMessage');?>",{message_sended : sendtext,str_otherMembers : <?php echo $user_info['user_id']; ?>});
					}
		}
	});
});

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
				//alert('1111');
				if(json.type=='deleteFollow'){$('.button_follow_status').removeClass('followed').addClass('follow');}
				else if (json.type=='addFollow'){$('.button_follow_status').removeClass('follow').addClass('followed');}
				//alert(json.type);
			}
			else
			{
				//alert('2222');
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
});
	
function messageAjaxtemp(function_for,type,url,data){
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
					case "SendNewMessage" :
						$("body").atomFly({ type : "tips", tips : "send ok" });
						$("#tipsPop").atomFly({type: "fadeOut"});
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
<?php
foreach ($dataNewsfeeds as $newsfeed)
{
?>
<article class="newsfeed normal" item_id="<?php echo $newsfeed['newsfeed_id'];?>">
    <section class="article">
   <!-- <span class="icon"></span>-->
    	<img src="<?php echo $newsfeed['avatar'];?>" class="userPhoto fl" alt="<?php echo CHtml::encode($newsfeed['firstname']).'&nbsp;'.CHtml::encode($newsfeed['lastname']);?>" />
    <aside class="fr">
    	<h6 class="Rows"><?php echo CHtml::encode($newsfeed['firstname']).'&nbsp;'.CHtml::encode($newsfeed['lastname']);?><span class="time"><?php echo $newsfeed['realtime'];?></span></h6>
    	<p><?php echo CHtml::encode($newsfeed['params']);?></p>
    </aside>
    	<div class="ClearBoth"></div>
    </section>
    <header class="less">
    	<span class="title addNewsfeedcom_<?php echo $newsfeed['newsfeed_id'];?>" onclick="openComment('<?php echo $newsfeed['newsfeed_id'];?>')">
    	<?php 
		echo $newsfeed['strfeedcomments'];
		?>
    	</span>
        <span class="tips closenewsfeedcom_<?php echo $newsfeed['newsfeed_id'];?>" onclick="closeComment('<?php echo $newsfeed['newsfeed_id'];?>')"></span></header>
    <section class="comment" item_id="<?php echo $newsfeed['newsfeed_id'];?>">
    	<ul class="commentList" id="commentList_<?php echo $newsfeed['newsfeed_id'];?>">
            <!--  S=循环体  -->
            <!--  E=循环体  -->
        </ul>
        <div class="sendBox">
        	<img src="<?php echo $newsfeed['avatar'];?>" class="userPhoto fl" alt="<?php echo $newsfeed['firstname'].'&nbsp;'.$newsfeed['lastname'];?>" />
            <input type="text" class="sendText fl sendCommendText_<?php echo $newsfeed['newsfeed_id'];?>"/>
            <input type="button" class="sendBtn fr" value="" item_id="<?php echo $newsfeed['newsfeed_id'];?>" onclick="sendNewsfeedCommend(<?php echo $newsfeed['newsfeed_id'];?>)"/>
       		<script>
			$('.sendCommendText_<?php echo $newsfeed['newsfeed_id'];?>').bind('keyup', function(event){
				var oThis = $(this);
				event.preventDefault();
				if (event.keyCode=="13")
				{
					if (oThis.val().length>1)
					{
						oButton = oThis.parent(".sendBox").children(".sendBtn");
						oButton.click();
					}
				}
			}); 
			</script>
        </div>
    </section>
</article>
<?php
}
?>
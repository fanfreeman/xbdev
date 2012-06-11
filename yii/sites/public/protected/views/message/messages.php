<?php
foreach($data as $message)
{
?>
	<li class="<?php echo $message['senderClass']; ?>">
		<a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$message['sender_id']));?>" title="<?php echo CHtml::encode($message['firstname']).'&nbsp;'.CHtml::encode($message['lastname']); ?>"><img src="<?php echo $message['avatar']; ?>" class="userPhoto" alt="" /></a>
		<aside class="message">
			<p><?php echo CHtml::encode($message['message']);?><span class="datetime"><?php echo $message['realtime'];?></span></p>
		</aside>
		<div class="ClearBoth"></div>
	</li>		
<?php
}
?>
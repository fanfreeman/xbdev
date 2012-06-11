<?php
if (isset($dataMessages))
{
	foreach($dataMessages as $message)
	{
		if ($message['type']=='1')
		{
?>      
       <li class="messages">
        <a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$message['sender_id']));?>" target="_blank"><img src="<?php echo $message['avatar'];?>" class="userPhoto fl" alt="" /></a>
        <aside class="fl">
        <h6><a href="<?php echo Yii::app()->createUrl('Profile/Index',array('uid'=>$message['sender_id']));?>" target="_blank"><?php echo $message['sender_firstname'];?></a><span><?php echo $message['realtime'];?></span></h6>
        <p><?php echo CHtml::encode($message['message']);?></p>
        </aside>
        </li>
        <div class="clearBoth"></div>
        <?php
		}
		else if($message['type']=='2')
		{
		?>
        <li class="systemMessage systemJoin"><?php echo CHtml::encode($message['message']);?></li>
        <div class="clearBoth"></div>
<?php
		}
	}
}
?>
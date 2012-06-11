<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('follow_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->follow_id), array('view', 'id'=>$data->follow_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('follower_id')); ?>:</b>
	<?php echo CHtml::encode($data->follower_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('following_id')); ?>:</b>
	<?php echo CHtml::encode($data->following_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>
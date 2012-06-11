<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->notification_id), array('view', 'id'=>$data->notification_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resource_id')); ?>:</b>
	<?php echo CHtml::encode($data->resource_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resource_type')); ?>:</b>
	<?php echo CHtml::encode($data->resource_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_read')); ?>:</b>
	<?php echo CHtml::encode($data->is_read); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>
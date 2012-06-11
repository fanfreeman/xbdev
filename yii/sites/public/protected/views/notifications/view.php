<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->notification_id,
);

$this->menu=array(
	array('label'=>'List Notifications', 'url'=>array('index')),
	array('label'=>'Create Notifications', 'url'=>array('create')),
	array('label'=>'Update Notifications', 'url'=>array('update', 'id'=>$model->notification_id)),
	array('label'=>'Delete Notifications', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->notification_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notifications', 'url'=>array('admin')),
);
?>

<h1>View Notifications #<?php echo $model->notification_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'notification_id',
		'user_id',
		'resource_id',
		'resource_type',
		'is_read',
		'created',
	),
)); ?>

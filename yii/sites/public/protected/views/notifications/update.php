<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->notification_id=>array('view','id'=>$model->notification_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Notifications', 'url'=>array('index')),
	array('label'=>'Create Notifications', 'url'=>array('create')),
	array('label'=>'View Notifications', 'url'=>array('view', 'id'=>$model->notification_id)),
	array('label'=>'Manage Notifications', 'url'=>array('admin')),
);
?>

<h1>Update Notifications <?php echo $model->notification_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php
$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Notifications', 'url'=>array('index')),
	array('label'=>'Manage Notifications', 'url'=>array('admin')),
);
?>

<h1>Create Notifications</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
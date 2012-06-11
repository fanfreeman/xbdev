<?php
$this->breadcrumbs=array(
	'Follows'=>array('index'),
	$model->follow_id=>array('view','id'=>$model->follow_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Follows', 'url'=>array('index')),
	array('label'=>'Create Follows', 'url'=>array('create')),
	array('label'=>'View Follows', 'url'=>array('view', 'id'=>$model->follow_id)),
	array('label'=>'Manage Follows', 'url'=>array('admin')),
);
?>

<h1>Update Follows <?php echo $model->follow_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
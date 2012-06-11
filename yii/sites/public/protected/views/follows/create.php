<?php
$this->breadcrumbs=array(
	'Follows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Follows', 'url'=>array('index')),
	array('label'=>'Manage Follows', 'url'=>array('admin')),
);
?>

<h1>Create Follows</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
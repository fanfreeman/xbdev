<?php
$this->breadcrumbs=array(
	'Group Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GroupMember', 'url'=>array('index')),
	array('label'=>'Manage GroupMember', 'url'=>array('admin')),
);
?>

<h1>Create GroupMember</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
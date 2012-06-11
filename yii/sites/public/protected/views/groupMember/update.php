<?php
$this->breadcrumbs=array(
	'Group Members'=>array('index'),
	$model->group_member_id=>array('view','id'=>$model->group_member_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GroupMember', 'url'=>array('index')),
	array('label'=>'Create GroupMember', 'url'=>array('create')),
	array('label'=>'View GroupMember', 'url'=>array('view', 'id'=>$model->group_member_id)),
	array('label'=>'Manage GroupMember', 'url'=>array('admin')),
);
?>

<h1>Update GroupMember <?php echo $model->group_member_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
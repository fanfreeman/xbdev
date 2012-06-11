<?php
$this->breadcrumbs=array(
	'Group Members'=>array('index'),
	$model->group_member_id,
);

$this->menu=array(
	array('label'=>'List GroupMember', 'url'=>array('index')),
	array('label'=>'Create GroupMember', 'url'=>array('create')),
	array('label'=>'Update GroupMember', 'url'=>array('update', 'id'=>$model->group_member_id)),
	array('label'=>'Delete GroupMember', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->group_member_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GroupMember', 'url'=>array('admin')),
);
?>

<h1>View GroupMember #<?php echo $model->group_member_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'group_member_id',
		'user_id',
		'group_id',
		'status',
		'message',
	),
)); ?>

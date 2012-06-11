<?php
$this->breadcrumbs=array(
	'Group Members',
);

$this->menu=array(
	array('label'=>'Create GroupMember', 'url'=>array('create')),
	array('label'=>'Manage GroupMember', 'url'=>array('admin')),
);
?>

<h1>Group Members</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

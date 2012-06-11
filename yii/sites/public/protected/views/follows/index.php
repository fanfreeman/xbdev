<?php
$this->breadcrumbs=array(
	'Follows',
);

$this->menu=array(
	array('label'=>'Create Follows', 'url'=>array('create')),
	array('label'=>'Manage Follows', 'url'=>array('admin')),
);
?>

<h1>Follows</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

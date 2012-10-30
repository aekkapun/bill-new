<?php
/* @var $this StaticIndexInputController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Static Index Inputs',
);

$this->menu=array(
	array('label'=>'Create StaticIndexInput', 'url'=>array('create')),
	array('label'=>'Manage StaticIndexInput', 'url'=>array('admin')),
);
?>

<h1>Static Index Inputs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

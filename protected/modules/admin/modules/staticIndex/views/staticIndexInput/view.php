<?php
/* @var $this StaticIndexInputController */
/* @var $model StaticIndexInput */

$this->breadcrumbs=array(
	'Static Index Inputs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StaticIndexInput', 'url'=>array('index')),
	array('label'=>'Create StaticIndexInput', 'url'=>array('create')),
	array('label'=>'Update StaticIndexInput', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StaticIndexInput', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StaticIndexInput', 'url'=>array('admin')),
);
?>

<h1>View StaticIndexInput #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'site_id',
		'static_index_id',
		'value',
		'input_date',
		'created_at',
		'updated_at',
	),
)); ?>

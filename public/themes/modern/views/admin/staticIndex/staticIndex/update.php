<?php
/* @var $this StaticIndexController */
/* @var $model StaticIndex */

$this->breadcrumbs=array(
	'Static Indexes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StaticIndex', 'url'=>array('index')),
	array('label'=>'Create StaticIndex', 'url'=>array('create')),
	array('label'=>'View StaticIndex', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StaticIndex', 'url'=>array('admin')),
);
?>

<h1>Update StaticIndex <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
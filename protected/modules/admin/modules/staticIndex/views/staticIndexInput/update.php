<?php
/* @var $this StaticIndexInputController */
/* @var $model StaticIndexInput */

$this->breadcrumbs=array(
	'Static Index Inputs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StaticIndexInput', 'url'=>array('index')),
	array('label'=>'Create StaticIndexInput', 'url'=>array('create')),
	array('label'=>'View StaticIndexInput', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage StaticIndexInput', 'url'=>array('admin')),
);
?>

<h1>Update StaticIndexInput <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
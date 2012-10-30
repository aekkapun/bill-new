<?php
/* @var $this StaticIndexInputController */
/* @var $model StaticIndexInput */

$this->breadcrumbs=array(
	'Static Index Inputs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StaticIndexInput', 'url'=>array('index')),
	array('label'=>'Manage StaticIndexInput', 'url'=>array('admin')),
);
?>

<h1>Create StaticIndexInput</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
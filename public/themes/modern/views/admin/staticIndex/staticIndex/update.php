<?php
/* @var $this StaticIndexController */
/* @var $model StaticIndex */

$this->breadcrumbs=array(
	'Static Indexes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1 class="h1-small">Обновить статический показатель <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
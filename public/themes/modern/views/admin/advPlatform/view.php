<?php
$this->breadcrumbs=array(
	'Рекламные площадки'=>array('index'),
	$model->name,
);

$this->menu=array(
    array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Обновить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить эту запись?')),
);
?>

<h1><?php echo CHtml::encode($model->name) ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_at',
		'updated_at',
	),
)); ?>

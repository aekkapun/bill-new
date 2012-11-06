<?php
$this->breadcrumbs=array(
	'Site Ranges'=>array('index'),
	$model->id,
);

$this->menu=array(
    array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Обновить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Список', 'url'=>array('index', 'SiteRange[site_id]' => $model->site_id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить эту запись?')),
);
?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'site_id',
		'valueMin',
		'valueMax',
		'price',
        array(
		    'name' => 'name_id',
		    'value' => $model->name->name,
		),
        'created_at',
		'updated_at',
	),
)); ?>

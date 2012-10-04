<?php
$this->breadcrumbs=array(
	'Site Ranges'=>array('index'),
	'Список',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('site-range-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$ranges = $model->search();
$ranges->pagination->pageSize = 20;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'site-range-grid',
	'dataProvider' => $ranges,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'valueMin',
		'valueMax',
		'price',
		array(
			'name' => 'created_at',
			'filter' => false,
		),
		/*
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

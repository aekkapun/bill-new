<?php
$this->breadcrumbs=array(
	'Factors'=>array('index'),
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
	$.fn.yiiGridView.update('factor-grid', {
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
$factors = $model->search();
$factors->pagination->pageSize = 20;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'factor-grid',
	'dataProvider' => $factors,
	'filter'=>null,
	'columns'=>array(
		'id',
		'name',
		array(
            'name' => 'system_id',
            'value' => 'Factor::getLabel($data->system_id)'
        ),
		'position',
		'value',
		'created_at',
		/*
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));

?>
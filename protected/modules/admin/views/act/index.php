<?php
$this->breadcrumbs=array(
	'Акты'=>array('index'),
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
	$.fn.yiiGridView.update('act-grid', {
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
$acts = $model->search();
$acts->pagination->pageSize = 20;

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'act-grid',
	'dataProvider' => $acts,
	'filter'=>null,
	'columns'=>array(
		'id',
		'number',
        array(
            'name' => 'sum',
            'type' => 'number'
        ),
        array(
            'name' => 'client_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->client->name, array("/admin/client/view", "id"=>$data->client->id))',
        ),
        array(
            'name' => 'contract_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->contract->number, array("/admin/contract/view", "id"=>$data->contract->id))',
        ),
        array(
            'name' => 'period',
            'type' => 'date',
            'value' => 'strtotime($data->period)',
        ),
        'signed:boolean',
	
		/*
		//'file',
		//'created_at',
		//'updated_at',
		*/
		
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>

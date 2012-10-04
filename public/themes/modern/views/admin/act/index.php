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

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'button',
    'type' => 'info',
    'label' => 'Расширенный поиск',
    'toggle' => true,
    'htmlOptions' => array('class' => 'search-button'),
)); ?>
</p>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
$acts = $model->search();
$acts->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
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
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
	),
));
?>

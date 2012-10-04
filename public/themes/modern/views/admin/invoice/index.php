<?php
$this->breadcrumbs=array(
	'Счет-фактура'=>array('index'),
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
	$.fn.yiiGridView.update('invoice-grid', {
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
$invoices = $model->search();
$invoices->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
	'id'=>'invoice-grid',
	'dataProvider'=>$invoices,
	'filter'=>null,
	'columns'=>array(
		'id',
		'number',
		array(
            'name' => 'client.name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->client->name, array("/admin/client/view", "id" => $data->client->id))',
        ),
		array(
			'name' => 'contract.number',
		    'type' => 'raw',
            'value' => 'CHtml::link($data->contract->number, array("/admin/contract/view", "id" => $data->contract->id))',
		),
		'period',
		/*
		'created_at',
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>

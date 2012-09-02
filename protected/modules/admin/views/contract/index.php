<?php
$this->breadcrumbs = array(
    'Договоры' => array('index'),
    'Список',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contract-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список</h1>

<?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php
$dataProvider = $model->search();
$dataProvider->pagination->pageSize = 20;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contract-grid',
	'dataProvider'=> $dataProvider,
	'filter' => null,
	'columns'=>array(
		'id',
		array(
			'header' => 'Вложения',
			'name' => 'attachments_count',
			'type' => 'html',
			'value'=>'($data->attachments_count)?CHtml::image("/images/check.png"):"&nbsp;"',	
		),
		array(
            'name' => 'number',
            'type' => 'raw',
            'value' => 'CHtml::link($data->number, array("/admin/contract/view", "id"=>$data->id))',
        ),
		array(
            'name' => 'client.name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->client->name, array("/admin/client/view", "id" => $data->client->id))',
        ),
		array(
			'name' => 'status',
			'value' => '$data->statusLabel',
		),
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>

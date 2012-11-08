<?php
$this->breadcrumbs = array(
    'Транзакции' => array('index'),
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
	$.fn.yiiGridView.update('transaction-grid', {
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
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php
$transactions = $model->search();
$transactions->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'transaction-grid',
    'dataProvider' => $transactions,
    'filter' => null,
    'columns' => array(
        'id',
        array(
            'name' => 'contract.number',
            'type' => 'raw',
            'value' => 'CHtml::link($data->contract->number, array("/admin/contract/view", "id" => $data->contract->id))',
        ),
        array(
            'header' => 'Клиент',
            'name' => 'contract.client.name',
        ),
		'details',
		'sum:number',
        array(
            'name' => 'type',
            'value' => '$data->typeLabel',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
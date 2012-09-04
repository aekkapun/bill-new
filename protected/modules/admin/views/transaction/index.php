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

<?php echo CHtml::link('Расширенный поиск', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php
$transactions = $model->search();
$transactions->pagination->pageSize = 20;

$this->widget('zii.widgets.grid.CGridView', array(
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
		'details',
		'sum:number',
		'type',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
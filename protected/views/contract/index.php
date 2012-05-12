<?php
$this->breadcrumbs = array(
    'Договоры' => array('index'),
    'Список',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contract-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список договоров</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'contract-grid',
    'dataProvider' => $model->search(),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        array(
            'class' => 'CLinkColumn',
            'urlExpression' => 'Yii::app()->createUrl("contract/view", array("id" => $data->id))',
            'labelExpression' => '$data->number'
        ),
        'statusLabel',
        array(
            'header' => 'Дата создания',
            'type' => 'date',
            'value' => 'strtotime($data->created_at)'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}'
        ),
    ),
)); ?>

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
            'header' => 'Номер',
            'class' => 'CLinkColumn',
            'urlExpression' => 'Yii::app()->createUrl("contract/view", array("id" => $data->id))',
            'labelExpression' => '$data->number ." от ". Yii::app()->dateFormatter->format("d MMMM y", strtotime($data->created_at))'
        ),
        'statusLabel',
    ),
)); ?>

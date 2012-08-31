<?php
$this->breadcrumbs = array(
    'Счета' => array('index'),
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
	$.fn.yiiGridView.update('bill-grid', {
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'bill-grid',
    'dataProvider' => $model->search(),
    'filter' => null,
    'columns' => array(
        'id',
        array(
            'header' => 'Клиент',
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->client->name',
            'urlExpression' => 'Yii::app()->createUrl("/admin/client/view/", array("id" => $data->client->id))',
        ),
        array(
            'header' => 'Номер договора',
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->contract->number',
            'urlExpression' => 'Yii::app()->createUrl("/admin/contract/view/", array("id" => $data->id))',
        ),
        'number',
        'sum',
        /*
          'period',
          'created_at',
          'updated_at',
          */
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>

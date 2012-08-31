<?php
$this->breadcrumbs = array(
    'Site Phrases' => array('index'),
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
	$.fn.yiiGridView.update('site-phrase-grid', {
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
    'id' => 'site-phrase-grid',
    'dataProvider' => $model->search(),
    'filter' => null,
    'columns' => array(
        'id',
        array(
            'header' => 'Запрос',
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->phrase',
            'urlExpression' => 'Yii::app()->createUrl("/admin/site/phrase/view/", array("id" => $data->id))',
        ),
        array(
            'header' => 'Сайт',
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->site->domain',
            'urlExpression' => 'Yii::app()->createUrl("/admin/site/default/view/", array("id" => $data->site->id))',
        ),
        array(
            'header' => 'Цена',
            'type' => 'raw',
            'value' => 'Yii::app()->numberFormatter->formatCurrency($data->price, "RUB")',
        ),
        'created_at',
        'updated_at',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>

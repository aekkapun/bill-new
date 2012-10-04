<?php
$this->breadcrumbs = array(
    'Рекламные площадки' => array('index'),
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
	$.fn.yiiGridView.update('adv-platform-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список рекламных площадок</h1>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType' => 'button',
    'type' => 'info',
    'label' => 'Расширенный поиск',
    'toggle' => true,
    'htmlOptions' => array('class' => 'search-button'),
)); ?>

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
		'model' => $model,
		'percentArray' => $percentArray,
	)); ?>
</div><!-- search-form -->

<?php
$advPlatforms = $model->search();
$advPlatforms->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'adv-platform-grid',
    'dataProvider' => $advPlatforms,
    'filter' => null,
    'columns' => array(
        'id',
        array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name, array("/admin/advPlatform/view", "id" => $data->id))'
        ),
        array(
            'name' => 'work_percent',
            'type' => 'raw',
            'value' => 'Yii::app()->numberFormatter->formatPercentage($data->work_percent)',
        ),
		/*
        'created_at',
        'updated_at',
        */
		array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>

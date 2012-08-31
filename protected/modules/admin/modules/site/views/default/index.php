<?php
$this->breadcrumbs = array(
    'Сайты' => array('index'),
    'Список',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create'), 'visible' => Yii::app()->user->checkAccess('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('site-grid', {
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
    'id' => 'site-grid',
    'dataProvider' => $model->search(),
    'filter' => null,
    'columns' => array(
        'id',
        array(
            'name' => 'domain',
            'type' => 'raw',
            'value' => 'CHtml::link($data->domain, array("/admin/site/default/view", "id" => $data->id))',
        ),
        array(
            'name' => 'client_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->client->name, array("/admin/client/view", "id"=>$data->client->id))',
        ),
        'created_at',
        'updated_at',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>

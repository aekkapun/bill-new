<?php
$this->breadcrumbs = array(
    'Запросы' => array('index'),
);
if(isset($_GET['SitePhrase']['site_id'])) {
    $this->breadcrumbs[$model->site->domain] = array('/admin/view/site', 'id' => $model->site->id);
}

//-----------

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
        array(
            'name' => 'phrase',
            'type' => 'raw',
            'value' => 'CHtml::link($data->phrase, array("/admin/site/phrase/view", "id" => $data->id))',
        ),
        array(
            'name' => 'site_id',
            'type' => 'raw',
            'value' => 'CHtml::link($data->site->domain, array("/admin/site/default/view", "id" => $data->site->id))',
        ),
        array(
            'name' => 'price',
            'type' => 'raw',
            'value' => 'Yii::app()->numberFormatter->formatCurrency($data->price, "RUB")',
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>

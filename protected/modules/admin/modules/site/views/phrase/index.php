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

<?php
$phrases = $model->search();
$phrases->pagination->pageSize = 20;

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-phrase-grid',
    'dataProvider' => $phrases,
    'filter' => null,
    'columns' => array(
        'id',
        'phrase',
        array(
            'name' => 'price',
            'type' => 'raw',
            'value' => 'Yii::app()->numberFormatter->formatCurrency($data->price, "RUB")',
        ),
        'created_at',
        'updated_at',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>

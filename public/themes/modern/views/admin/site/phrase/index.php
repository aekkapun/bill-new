<?php
$this->breadcrumbs = array(
    'Запросы' => array('index'),
);
if(isset($_GET['SitePhrase']['site_id'])) {
    $this->breadcrumbs[$model->site->domain] = array('/admin/view/site', 'id' => $model->site->id);
}
?>

<?php
$this->menu = array(
    array('label' => 'Создать', 'url' => array('create', 'siteId' => Yii::app()->request->getQuery('siteId'))),
);
?>

<?php
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
$phrases = $model->search();
$phrases->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
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
        array(
            'header' => 'Группа',
            'name' => 'group.name',
            'value' => '$data->group->name ? $data->group->name : SitePhraseGroup::DEFAULT_NAME'
        ),
        'created_at',
        'updated_at',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>

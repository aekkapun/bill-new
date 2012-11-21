<?php
$this->breadcrumbs=array(
	'Статические показатели'=>array('index'),
	'Список',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('static-index-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Названия диапазонов</h1>

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
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div>



<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'static-index-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'id',
        'name',
        array(
            'header' => $model->getAttributeLabel('site_id'),
            'name' => 'site.domain',
        ),
        array(
            'header' => $model->getAttributeLabel('contract_id'),
            'name' => 'contract.number',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{update}{delete}'
        ),
    ),
)); ?>

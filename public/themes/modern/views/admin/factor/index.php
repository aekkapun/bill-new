<?php
$this->breadcrumbs = array(
    'Factors' => array('index'),
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
	$.fn.yiiGridView.update('factor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Список коэффициентов</h1>

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
$factors = $model->search();
$factors->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'factor-grid',
    'dataProvider' => $factors,
    'filter' => null,
    'columns' => array(
        'id',
        'name',
        array(
            'name' => 'system_id',
            'value' => 'Factor::getLabel($data->system_id)'
        ),
        'position',
        'value',
        'created_at',
        /*
          'updated_at',
          */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));

?>
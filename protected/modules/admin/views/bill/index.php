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
        'client.name:Клиент',
        'contract.number:Номер договора',
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

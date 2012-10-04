<?php
$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	'Список',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('accountant')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('client-grid', {
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
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$dataProvider = $model->search();
$dataProvider->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
	'id'=>'client-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null,
	'columns'=>array(
		'id',
		array(
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name, array("/admin/client/view", "id" => $data->id))',
        ),  
		array(
			'header' => 'Менеджер',
			'name' => 'managerName',
			'value' => '$data->manager->name',
		),
		'address',
		'is_corporate:boolean',

        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

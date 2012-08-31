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

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$dataProvider = $model->search();
$dataProvider->pagination->pageSize = 20;
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'client-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>null,
	'columns'=>array(
		'id',
        array(
            'class' => 'CLinkColumn',
            'labelExpression' => '$data->name',
            'urlExpression' => 'Yii::app()->createUrl("/admin/client/view/", array("id" => $data->id))',
        ),
        'manager.name:Менеджер',
		'address',
		'is_corporate:boolean',
		/*
		'post_code',
		'code_1c',
		'phone',
		'status',
		'created_at',
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

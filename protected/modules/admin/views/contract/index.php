<?php
$this->breadcrumbs=array(
	'Договоры'=>array('index'),
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
	$.fn.yiiGridView.update('contract-grid', {
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
	'id'=>'contract-grid',
	'dataProvider'=> $dataProvider,
	'filter' => null,
	'columns'=>array(
		'id',
		array(
			'name'=>'File',
			'type'=>'html',
			'value'=>'($data->hasAttachment())?CHtml::image("/images/check.png"):"&nbsp;"',
		),
		'number',
		'client.name',
		'statusLabel',
		'created_at',
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>

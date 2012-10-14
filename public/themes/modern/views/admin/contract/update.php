<?php
$this->breadcrumbs=array(
	'Договоры'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
	array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Список', 'url'=>array('index')),
);
?>

<h1>Обновить договор <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'contract-files',
    'dataProvider' => $attachments,
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        array(
            'header' => 'Вложения',
            'name' => 'name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->name,$data->getFile())',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->createUrl("admin/contract/deleteAttachment", array("id" => $data->id))',
            'deleteConfirmation' => 'Вы действительно хотите удалить это вложение?',
        ),
    ),
));
?>

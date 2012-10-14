<?php
$this->breadcrumbs = array(
    $model->client->name => array('/admin/client/view', 'id' => $model->id),
    'Договоры' => array('index'),
    $model->number,
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Обновить', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Список', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?')),
);
?>

<h1><?php echo CHtml::encode($model->client->name) ?> #<?php echo CHtml::encode($model->number) ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'number',
        'client.name',
        'statusLabel',
        'created_at',
        'updated_at',
    ),
)); ?>

<br/>

<?php
$attachments->pagination->pageSize = 20;

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

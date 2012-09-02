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

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
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

<h2>Прикрепленные файлы</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
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
    ),
)); ?>

<?php
$this->breadcrumbs = array(
    'Отчеты' => array('index'),
    $model->client->name => array('/admin/client/view/', 'id' => $model->client->id),
    'Общий отчет'
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Список', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?')),
);
?>

<h1>Просмотр</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'type' => 'date',
            'name' => 'period_begin',
            'value' => strtotime($model->period_begin),
        ),
        array(
            'type' => 'date',
            'name' => 'period_end',
            'value' => strtotime($model->period_end),
        ),
        array(
            'name' => 'client.name',
            'type' => 'raw',
            'value' => CHtml::link($model->client->name, array("/admin/client/view", "id" => $model->client->id)),
        ),
        array(
            'type' => 'raw',
            'name' => 'status',
            'value' => $model->getStatusLabel()
        ),
        array(
            'type' => 'raw',
            'name' => 'contract_status',
            'value' => $model->getContractStatusLabel()
        ),
        'created_at',
        'updated_at',
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'report-position-grid',
    'dataProvider' => new CArrayDataProvider($position),
    'filter' => null,
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => $data->bySystemId(Factor::SYSTEM_YANDEX)->count(),
        ),
    ),
)); ?>

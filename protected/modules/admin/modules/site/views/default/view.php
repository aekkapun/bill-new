<?php
$this->breadcrumbs = array(
    'Сайты' => array('index'),
    $model->domain,
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Обновить', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Список', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?')),

    array('label' => "Запросы"),
    array('label' => 'Список запросов', 'url' => array('/admin/site/phrase')),
    array('label' => 'Добавить запрос', 'url' => array('/admin/site/phrase/create')),

    array('label' => "Диапазоны"),
    array('label' => 'Список диапазонов', 'url' => array('/admin/site/range')),
    array('label' => 'Добавить диапазон', 'url' => array('/admin/site/range/create')),

    array('label' => "Добавить услугу"),
    array('label' => 'Абонентская плата', 'url' => array('/admin/service/subscription/subscribe', 'siteId' => $model->id)),
    array('label' => 'Оплата по позициям', 'url' => array('/admin/service/position/subscribe', 'siteId' => $model->id)),
    array('label' => 'Оплата по переходам', 'url' => array('/admin/service/transition/subscribe', 'siteId' => $model->id)),
    array('label' => 'Контекстная реклама', 'url' => array('/admin/service/context/subscribe', 'siteId' => $model->id)),
);
?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'client.name',
        'domain:url',
        'created_at',
        'updated_at',
    ),
)); ?>

<h2>Запросы</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-phrase-grid',
    'dataProvider' => new CArrayDataProvider($model->sitePhrases),
    'filter' => null,
    'columns' => array(
        'id',
        'phrase',
        'price',
        'active:boolean'
    ),
)); ?>

<h2>Диапазоны</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-range-grid',
    'dataProvider' => new CArrayDataProvider($model->siteRanges),
    'filter' => null,
    'columns' => array(
        'valueMin',
        'valueMax',
        'price',
    ),
)); ?>

<h2>Подключенные услуги</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-service-grid',
    'dataProvider' => new CArrayDataProvider($services),
    'filter' => null,
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => 'CHtml::link(Service::getLabel($data["service_id"]), array("/admin/service/".Service::getControllerName($data["service_id"])."/input", "siteId" => $data["site_id"]))'
        ),
        array(
            'type' => 'date',
            'value' => 'strtotime($data["created_at"])'
        )
    ),
)); ?>
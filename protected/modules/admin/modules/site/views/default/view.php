<?php
$this->breadcrumbs = array(
    'Сайты' => array('index'),
    $model->domain,
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Обновить', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Список', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?'), 'visible' => Yii::app()->user->checkAccess('admin')),

    array('label' => "Запросы", 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Список запросов', 'url' => array('/admin/site/phrase'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Добавить запрос', 'url' => array('/admin/site/phrase/create'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Импорт запросов', 'url' => array('/admin/import/default'), 'visible' => Yii::app()->user->checkAccess('admin')),

    array('label' => "Диапазоны", 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Список диапазонов', 'url' => array('/admin/site/range'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Добавить диапазон', 'url' => array('/admin/site/range/create'), 'visible' => Yii::app()->user->checkAccess('admin')),

    array('label' => "Добавить услугу"),
    array('label' => 'Абонентская плата', 'url' => array('/admin/service/subscription/subscribe', 'siteId' => $model->id)),
    array('label' => 'Оплата по позициям', 'url' => array('/admin/service/position/subscribe', 'siteId' => $model->id)),
    array('label' => 'Оплата по переходам', 'url' => array('/admin/service/transition/subscribe', 'siteId' => $model->id)),
    array('label' => 'Контекстная реклама', 'url' => array('/admin/service/context/subscribe', 'siteId' => $model->id)),
    array('label' => 'Баннерная реклама', 'url' => array('/admin/service/banner/subscribe', 'siteId' => $model->id)),
    array('label' => 'Разовая услуга', 'url' => array('/admin/service/onetime/subscribe', 'siteId' => $model->id)),

    array('label' => "История", 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Действия по сайту', 'url' => array('/admin/site/default/log', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),
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
        'region',
    ),
)); ?>

<br>

<h2>Запросы</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-phrase-grid',
    'dataProvider' => new CArrayDataProvider($model->sitePhrases),
    'filter' => null,
    'columns' => array(
        'id:number:ID',
        'phrase:Запрос',
        'price:Цена',
        'active:boolean:Активен?'
    ),
)); ?>

<h2>Диапазоны</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-range-grid',
    'dataProvider' => new CArrayDataProvider($model->siteRanges),
    'filter' => null,
    'columns' => array(
        'valueMin:Мин',
        'valueMax:Макс',
        'price:Цена',
    ),
)); ?>

<h2>Подключенные услуги</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-service-grid',
    'dataProvider' => $services,
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Название',
            'type' => 'raw',
            'value' => 'CHtml::link(Service::getLabel($data->service_id, $data->id), array("/admin/service/".Service::getControllerName($data->service_id)."/input", "ssId" => $data->id))'
        ),
        'contract.number',
        array(
            'header' => 'Дата подключения/изменения',
            'type' => 'date',
            'value' => 'strtotime($data["created_at"])',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{terminate}',
            'buttons' => array(
                'terminate' => array(
                    'label' => 'Отключить услугу',
                    'url' => 'Yii::app()->createUrl("admin/service/" . Service::getControllerName($data->service_id) . "/terminate", array("ssId" => $data->id))',
                ),
            ),
            'htmlOptions' => array(
                'width' => 100,
            ),
        ),
    ),
)); ?>
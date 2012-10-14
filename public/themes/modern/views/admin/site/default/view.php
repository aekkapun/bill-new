<?php
$this->breadcrumbs = array(
    'Сайты' => array('index'),
    $model->domain,
);

$this->menu = array(
    array('label' => "Управление", 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Создать', 'url' => array('create'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Обновить', 'url' => array('update', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Список', 'url' => array('index')),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?'), 'visible' => Yii::app()->user->checkAccess('admin')),

    array('label' => "Запросы", 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Список запросов', 'url' => array('/admin/site/phrase/index', 'SitePhrase[site_id]' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Добавить запрос', 'url' => array('/admin/site/phrase/create'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Импорт запросов', 'url' => array('/admin/import/default/index/src/phraseImport'), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Очистить список запросов', 'url' => '#', 'linkOptions' => array('submit' => array('/admin/site/phrase/deleteAll', 'siteId' => $model->id), 'confirm' => 'Вы действительно хотите удалить все запросы?'), 'visible' => Yii::app()->user->checkAccess('admin') && count($model->sitePhrases)),

    array('label' => "Диапазоны", 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Список диапазонов', 'url' => array('/admin/site/range/index', 'siteId' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),
    array('label' => 'Добавить диапазон', 'url' => array('/admin/site/range/create', 'siteId' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),

    array('label' => "Добавить услугу"),
    array('label' => 'Абонентская плата', 'url' => array('/admin/service/subscription/subscribe', 'siteId' => $model->id)),
    array('label' => 'Оплата по позициям', 'url' => array('/admin/service/position/subscribe', 'siteId' => $model->id)),
    array('label' => 'Оплата по переходам', 'url' => array('/admin/service/transition/subscribe', 'siteId' => $model->id)),
    array('label' => 'Контекстная реклама', 'url' => array('/admin/service/context/subscribe', 'siteId' => $model->id)),
    array('label' => 'Баннерная реклама', 'url' => array('/admin/service/banner/subscribe', 'siteId' => $model->id)),
    array('label' => 'Разовая услуга', 'url' => array('/admin/service/onetime/subscribe', 'siteId' => $model->id)),

    array('label' => "История", 'visible' => Yii::app()->user->checkAccess('admin')),
//    array('label' => 'Действия по сайту', 'url' => array('/admin/site/default/log', 'id' => $model->id), 'visible' => Yii::app()->user->checkAccess('admin')),
);
?>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<h1>Общая информация</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
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

<br/>

<h2>Подключенные услуги</h2>

<?php
$siteServices->pagination->pageSize = 20;

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'site-service-grid',
    'dataProvider' => $siteServices,
    'template' => '{items}<br/>{pager}',
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Название',
            'type' => 'raw',
            'name' => 'name',
            'value' => 'CHtml::link(Service::getLabel($data->service_id, $data->id), array("/admin/service/".Service::getControllerName($data->service_id)."/input", "ssId" => $data->id))'
        ),
        array(
            'header' => 'Номер договора',
            'name' => 'contract.number',
            'type' => 'raw',
            'value' => 'CHtml::link($data->contract->number, array("/admin/contract/view", "id"=>$data->contract->id))',
        ),
        array(
            'header' => 'Дата подключения/изменения',
            'type' => 'date',
            'name' => 'created_at',
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
));
?>

<br/>

<?php
$this->widget('CTabView', array(
    'tabs' => array(
        'phrases' => array(
            'title' => 'Запросы',
            'view' => '/phrase/_grid',
            'data' => array('model' => $model),
        ),
        'ranges' => array(
            'title' => 'Диапазоны',
            'view' => '/range/_grid',
            'data' => array('model' => $model),
        ),

    ),
))
?>
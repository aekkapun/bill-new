<?php
$this->breadcrumbs = array(
    'Site Phrases' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
    array('label' => 'Обновить', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Список', 'url' => array('index', 'SitePhrase[site_id]' => $model->site_id)),
    array('label' => 'Удалить', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Вы действительно хотите удалить эту запись?')),
);
?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'site_id',
        'phrase',
        'hash',
        array(
            'name' => 'price',
            'type' => 'raw',
            'value' => Yii::app()->numberFormatter->formatCurrency($model->price, "RUB"),
        ),
        'created_at',
        'updated_at',
    ),
)); ?>

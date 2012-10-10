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

<h1><?php echo $model->name; ?></h1>

<h2>Отчёт за период с <?php echo $model->period_begin; ?> по <?php echo $model->period_end; ?></h2>

<h3>Сводная информация по услугам</h3>

<h4 class="report-section-header">По услуге "Оплата по позициям"</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($position),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Система',
            'value' => 'Factor::$labels[$data->system_id]',
        ),
        array(
            'header' => 'Сумма',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
    ),
)); ?>


<h4 class="report-section-header">По услуге "Абонентская плата"</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($subscription),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Сумма',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
    ),
)); ?>


<h4 class="report-section-header">По услуге "Контекстная реклама"</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($context),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Бюджет',
            'name' => 'budget',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Кол-во переходов',
            'name' => 'transition_sum',
        ),
        array(
            'header' => 'Средняя стоимость перехода',
            'name' => 'avg_transition_price',
            'class'  => 'TotalColumn',
        ),
    ),
)); ?>


<h4 class="report-section-header">По услуге "Баннерная реклама"</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($banner),
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Сайт',
            'value' => '$data->site->domain',
            'footer' => '<strong>Итого</strong>'
        ),
        array(
            'header' => 'Сумма',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Кол-во кликов',
            'name' => 'transition_sum',
        ),
        array(
            'header' => 'Средняя цена клика',
            'value'  => 'Yii::app()->numberFormatter->format("#,##0.00", $data->sum / $data->transition_sum)',
        ),
    ),
)); ?>


<h4 class="report-section-header">По прочим услугам</h4>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($custom),
    'filter' => null,
    'columns' => array(
        array(
            'name' => 'Название',
            'value' => '$data->name',
            'footer' => '<strong>Итого</strong>',
        ),
        array(
            'header' => 'Сумма',
            'name' => 'price',
            'class'  => 'TotalColumn',
        ),
    ),
)); ?>



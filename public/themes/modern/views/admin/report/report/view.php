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
<?php  $this->widget('bootstrap.widgets.TbGridView', array(
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
            'header' => 'Yandex',
            'name' => 'yandex',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Google',
            'name' => 'google',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Всего',
            'name' => 'sum',
            'class'  => 'TotalColumn',
        ),
    ),
));  ?>


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
        array(
            'header' => 'Количество ссылок',
            'name' => 'link_count',
        ),
        array(
            'header' => 'Средняя стоимость ссылки',
            'value' => 'Yii::app()->numberFormatter->format("#,##0.00", $data->sum / $data->link_count)',
        ),
    ),
)); ?>


<h4 class="report-section-header">По услуге "Контекстная реклама"</h4>
<?php $this->widget('TbGroupedGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($context),
    'filter' => null,
    'groupField' => 'site_id',
    'sectionList' => ReportContext::getSectionData(),
    'columns' => array(
        array(
            'header' => 'Площадка',
            'name' => 'platform_id',
            'value' => 'AdvPlatform::$labels[$data["platform_id"]]',
            'footer' => '<strong>Итого</strong>',
        ),
        array(
            'header' => 'Бюджет',
            'name' => 'budget',
            'class'  => 'TotalColumn',
        ),
        array(
            'header' => 'Средняя стоимость перехода',
            'name' => 'avg_transition_price',
        ),
        array(
            'header' => 'Сумма',
            'name' => 'transition_sum',
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
<?php $this->widget('bootstrap.widgets.TbGroupedGridView', array(
    'type' => 'striped bordered',
    'template' => '{items}',
    'htmlOptions' => array('class' => 'report-section-grid'),
    'dataProvider' => new CArrayDataProvider($custom),
    'filter' => null,
    'groupField' => 'site_id',
    'sectionList' => ReportCustom::getSectionData(),
    'columns' => array(
        array(
            'name' => 'name',
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



<div class="report-total">
    <div class="row">
        <div class="span5">Итого за период с <?php echo $model->period_begin; ?> по <?php echo $model->period_end; ?></div>
        <div class="span2 report-total-sum"><?php echo Yii::app()->numberFormatter->formatCurrency($totalBalancePerPeriod, 'RUB'); ?></div>
    </div>
    <div class="row">
        <div class="span5">Баланс по договору</div>
        <div class="span2 report-total-sum"><?php echo Yii::app()->numberFormatter->formatCurrency($balanceByContract, 'RUB'); ?></div>
    </div>
    <div class="row">
        <div class="span5">Итого к оплате</div>
        <div class="span2 report-total-sum"><?php echo Yii::app()->numberFormatter->formatCurrency($totalBalance, 'RUB'); ?></div>
    </div>
</div>


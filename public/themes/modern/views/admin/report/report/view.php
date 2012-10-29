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


<!-- Сводная информация по услугам -->
<?php $this->renderPartial('_report_tables', array(
    'reports' => $reports,
)); ?>


<!-- Файлы -->
<h4 class="report-section-header">Файлы</h4>
<?php $this->renderPartial('_all_client_files', array(
    'filesDataProvider' => $model->getAttachedFiles(),
)); ?>


<div class="report-total">
    <div class="row">
        <div class="span5">Итого за период с <?php echo $model->period_begin; ?> по <?php echo $model->period_end; ?></div>
        <div class="span2 report-total-sum"><?php echo Yii::app()->numberFormatter->formatCurrency($balance['totalBalancePerPeriod'], 'RUB'); ?></div>
    </div>
    <div class="row">
        <div class="span5">Баланс по договору</div>
        <div class="span2 report-total-sum"><?php echo Yii::app()->numberFormatter->formatCurrency($balance['balanceByContract'], 'RUB'); ?></div>
    </div>
    <div class="row">
        <div class="span5">Итого к оплате</div>
        <div class="span2 report-total-sum"><?php echo Yii::app()->numberFormatter->formatCurrency($balance['totalBalance'], 'RUB'); ?></div>
    </div>
</div>


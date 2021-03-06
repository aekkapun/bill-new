<?php
$this->breadcrumbs = array(
    'Договоры' => array('index'),
    $model->number,
);
?>

<h1>Просмотр</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'number',
        'statusLabel',
        'created_at',
    ),
)); ?>

<br/>

<h2>Документы по договору</h2>

<?php if ($attachments): ?>
<?php foreach ($attachments as $attachment) : ?>
    <div class="row">
        <li><?php echo CHtml::link($attachment->name, $attachment->getFile()) ?></li>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<br/>

<h2>Акты</h2>

<?php if ($acts): ?>
<?php foreach ($acts as $act) : ?>
    <div class="row">
        <li><?php echo CHtml::link('Акт от ' . Yii::app()->dateFormatter->format('d MMMM yyyy', $act->period), $act->getFile()) ?></li>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<br/>

<h2>Счета</h2>

<?php if ($bills): ?>
<?php foreach ($bills as $bill) : ?>
    <div class="row">
        <li><?php echo CHtml::link('Счет от ' . Yii::app()->dateFormatter->format('d MMMM yyyy', $bill->period), $bill->getFile()) ?></li>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<br/>

<h2>Сайты по договору</h2>

<?php foreach ($sites as $site) : ?>
<div class="row">

    <h3><?php echo CHtml::link($site->domain, array('/site/view', 'id' => $site->id)) ?></h3>

    <p><strong>Подключенные услуги:</strong></p>
    <ul>
        <?php foreach ($site->siteServices as $siteService): ?>
        <li>
            <?php echo Service::getLabel($siteService->service_id) ?>
            c <?php echo Yii::app()->dateFormatter->format('d MMMM yyyy', $siteService->created_at) ?>
            <?php echo CHtml::link('Статистика', array('/stat/' . Service::getControllerName($siteService->service_id), 'siteId' => $siteService->site_id)) ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endforeach; ?>
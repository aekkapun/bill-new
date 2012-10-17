<h1>Подключение услуги</h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'position-subscribe-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>

    <?php echo $form->dropDownListRow($siteService, 'contract_id', Contract::getTogetherIdAndDate(array('client_id' => $site->client->id))); ?>

    <?php echo $form->labelEx($siteService, 'created_at'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $siteService,
        'attribute' => 'created_at',
        'language' => 'ru',
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd',
            'changeMonth' => true,
            'changeYear' => true,
            'showOn' => 'button',
            'buttonImage' => '/images/calendar.png',
            'buttonImageOnly' => true,
        ),
    )); ?>
    <?php echo $form->error($siteService, 'created_at'); ?>

<h2>Рекламные площадки</h2>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => new CArrayDataProvider($advPlatforms),
    'filter' => null,
    'template' => '{items}',
    'selectableRows' => 2,
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'advPlatforms',
        ),
        'name:Название',
        array(
            'header' => 'Бюджет',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[$data->id]budget")',
        ),
        array(
            'header' => 'Стоимость работ (%)',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[$data->id]work_percent")',
        ),

    ),
));
?>

<?php echo CHtml::activeHiddenField($siteService, 'site_id', array('value' => $site->id)) ?>
<?php echo CHtml::activeHiddenField($siteService, 'service_id', array('value' => $service->id)) ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('/shared/_info', array(
    'siteService' => $siteService,
    'site' => $site,
    'params' => isset($params) ? $params : null,
    'service' => isset($service) ? $service : null,
)) ?>
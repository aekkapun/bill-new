<h1>Добавление услуги</h1>

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

<h2>Коэффициенты</h2>

<?php echo $form->errorSummary($factors); ?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => new CArrayDataProvider($factors),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        array(
            'header' => 'Название',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[".$data->id."]name")',
        ),
        array(
            'header' => 'Значение коэффициента',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[".$data->id."]value", array("class" => "span1"))',
        ),
    ),
));
?>

<h2>Запросы</h2>

<?php echo $form->errorSummary($phrases); ?>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => new CArrayDataProvider($phrases, array(
        'pagination' => array(
            'pageSize' => 10,
        ),
    )),
    'filter' => null,
    'template' => "{items}<br>{pager}",
    'columns' => array(
        array(
            'header' => 'Запрос',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[".$data->id."]phrase")',
        ),
        array(
            'header' => 'Стоимость',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[".$data->id."]price", array("class" => "span1"))',
        ),

        array(
            'header' => 'Контрольная сумма',
            'type' => 'raw',
            'value' => 'CHtml::activeTextField($data, "[".$data->id."]hash", array("readonly" => true))',
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
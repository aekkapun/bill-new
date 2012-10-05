<h1>Подключение услуги</h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'subscription-subscribe-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>

<?php echo $form->errorSummary($siteService); ?>

<?php echo $form->dropDownListRow($siteService, 'contract_id', CHtml::listData(Contract::model()->findAllByAttributes(array('client_id' => $site->client->id)), 'id', 'number')) ?>

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

<?php echo $form->textFieldRow($subscriptionForm, 'sum', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($subscriptionForm, 'work_cost', array('size' => 10, 'maxlength' => 10)); ?>

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
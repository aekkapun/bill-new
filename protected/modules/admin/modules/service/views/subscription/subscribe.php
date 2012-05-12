<h1>Добавление услуги</h1>

<dl>
    <dt>Название:</dt>
    <dd><?php echo CHtml::encode($service->name) ?></dd>

    <dt>Сайт:</dt>
    <dd><?php echo CHtml::encode($site->domain) ?></dd>
</dl>


<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'subscription-subscribe-form',
    'enableAjaxValidation' => false,
)); ?>

    <?php echo $form->errorSummary($siteService); ?>

    <div class="row">
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
    </div>

    <div class="row">
        <?php echo $form->labelEx($subscriptionForm, 'sum'); ?>
        <?php echo $form->textField($subscriptionForm, 'sum', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($subscriptionForm, 'sum'); ?>
    </div>

    <?php echo CHtml::activeHiddenField($siteService, 'site_id', array('value' => $site->id)) ?>
    <?php echo CHtml::activeHiddenField($siteService, 'service_id', array('value' => $service->id)) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
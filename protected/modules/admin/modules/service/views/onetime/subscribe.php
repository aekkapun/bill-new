<h1>Добавление услуги</h1>

<dl>
    <dt>Название:</dt>
    <dd><?php echo CHtml::encode($service->name) ?></dd>

    <dt>Сайт:</dt>
    <dd><?php echo CHtml::encode($site->domain) ?></dd>
</dl>


<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'banner-subscribe-form',
    'enableAjaxValidation' => false,
)); ?>

    <?php echo $form->errorSummary($siteService); ?>

    <div class="row">
        <?php echo $form->labelEx($siteService, 'contract_id'); ?>
        <?php echo $form->dropDownList($siteService, 'contract_id', CHtml::listData(Contract::model()->findAllByAttributes(array('client_id' => $site->client->id)), 'id', 'number')) ?>
    </div>

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
        <?php echo $form->labelEx($onetimeForm, 'name'); ?>
        <?php echo $form->textField($onetimeForm, 'name', array('size' => 40)); ?>
        <?php echo $form->error($onetimeForm, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($onetimeForm, 'cost'); ?>
        <?php echo $form->textField($onetimeForm, 'cost', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($onetimeForm, 'cost'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($onetimeForm, 'delivered_at'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $onetimeForm,
            'attribute' => 'delivered_at',
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
        <?php echo $form->error($onetimeForm, 'delivered_at'); ?>
    </div>

    <?php echo CHtml::activeHiddenField($siteService, 'site_id', array('value' => $site->id)) ?>
    <?php echo CHtml::activeHiddenField($siteService, 'service_id', array('value' => $service->id)) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
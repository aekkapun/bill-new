<h1>Ввод данных по услуге</h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'banner-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>

<?php echo $form->labelEx($bannerInput, 'created_at'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $bannerInput,
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
        'htmlOptions' => array('value' => (empty($bannerInput->created_at) ? date('Y-m-d') : $bannerInput->created_at)),
    )); ?>

<?php echo $form->textFieldRow($bannerInput, 'transitions', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($bannerInput, 'sum', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->hiddenField($bannerInput, 'site_id', array('value' => $site->id)) ?>
<?php echo $form->hiddenField($bannerInput, 'contract_id', array('value' => $siteService->contract_id)) ?>


<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('/shared/_info', array(
    'siteService' => $siteService,
    'site' => $site,
    'params' => $params,
)) ?>
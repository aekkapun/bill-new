<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'invoice-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name'), array('empty' => '--выбрать--')); ?>

<?php echo $form->dropDownListRow($model, 'contract_id', CHtml::listData(Contract::model()->my()->findAll(), 'id', 'number'), array('empty' => '--выбрать--')); ?>

<?php echo $form->labelEx($model, 'period'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $model,
        'attribute' => 'period',
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
<?php echo $form->error($model, 'period'); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

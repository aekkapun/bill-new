<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'act-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'well'),
)); ?>

<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name'), array('empty' => '--выбрать--')); ?>

<?php echo $form->dropDownListRow($model, 'contract_id', CHtml::listData(Contract::model()->my()->findAll(), 'id', 'number'), array('empty' => '--выбрать--')); ?>

<?php echo $form->textFieldRow($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'sum', array('size' => 20, 'maxlength' => 20)); ?>

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

<?php echo $form->fileFieldRow($model, ($model->isNewRecord ? 'file' : 'newFile')); ?>

<?php if (!$model->isNewRecord): ?>
<?php if (!empty($model->file)): ?>
    <?php echo $model->getFile(); ?>
    <?php endif; ?>
<?php endif; ?>

<?php echo $form->checkboxRow($model, 'signed'); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

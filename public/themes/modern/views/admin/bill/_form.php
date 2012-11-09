<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'bill-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name'), array(
    'empty' => Yii::app()->params['emptySelectLabel'],
    'ajax' => array(
        'update' => '#Bill_contract_id',
        'url' => $this->createUrl('/admin/client/getContractsOptions'),
        'data' => 'js:"clientId="+this.value',
        'cache' => false,
    ),
)); ?>

<?php echo $form->dropDownListRow($model, 'contract_id', Contract::getTogetherIdAndDate(), array('empty' => Yii::app()->params['emptySelectLabel'])); ?>

<?php echo $form->textFieldRow($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'sum', array('size' => 20, 'maxlength' => 20)); ?>

<?php echo $form->fileFieldRow($model, ($model->isNewRecord ? 'file' : 'newFile')); ?>

<?php if (!empty($model->file)): ?>
<?php echo $model->getFile(); ?>
<?php endif; ?>

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
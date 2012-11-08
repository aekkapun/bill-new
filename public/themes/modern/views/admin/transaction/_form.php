<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'transaction-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'contract_id', Contract::getTogetherIdAndDate(), array('empty' => '--выбрать--')); ?>

<?php echo $form->textAreaRow($model, 'details', array('rows' => 6, 'cols' => 50)); ?>

<?php echo $form->textFieldRow($model, 'sum', array('size' => 20, 'maxlength' => 20)); ?>
<?php echo $form->radioButtonListRow($model, 'type', Transaction::$labels); ?>

<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'client-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'manager_id', CHtml::listData(User::model()->managers()->findAll(), 'id', 'name')); ?>

<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'address', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->checkboxRow($model, 'is_corporate'); ?>

<?php echo $form->textFieldRow($model, 'post_code', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'code_1c', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'phone', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'status', $model->statusLabels); ?>

<?php echo $form->labelEx($model, 'created_at'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $model,
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
<?php echo $form->error($model, 'created_at'); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

</div><!-- form -->
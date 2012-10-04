<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'adv-platform-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'budget', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'work_percent', array('size' => 60, 'maxlength' => 255)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>
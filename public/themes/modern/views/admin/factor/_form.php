<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'vertical',
    'id' => 'factor-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'system_id', Factor::$labels); ?>

<?php echo $form->textFieldRow($model, 'position', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'value', array('size' => 5, 'maxlength' => 5)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

</div><!-- form -->
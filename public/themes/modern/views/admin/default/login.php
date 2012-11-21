<h1>Панель управления</h1>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm'); ?>

<?php echo $form->textFieldRow($model, 'email'); ?>

<?php echo $form->passwordFieldRow($model, 'password'); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Войти')); ?>
</p>

<?php $this->endWidget(); ?>

<div class="form login">

    <?php $form = $this->beginWidget('CActiveForm'); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <?php echo CHtml::submitButton('Enter'); ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->

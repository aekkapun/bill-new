<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'adv-platform-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'budget'); ?>
        <?php echo $form->textField($model, 'budget', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'budget'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'work_percent'); ?>
        <?php echo $form->textField($model, 'work_percent', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'work_percent'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
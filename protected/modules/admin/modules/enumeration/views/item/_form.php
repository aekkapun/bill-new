<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'enumeration-item-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'enumeration_id'); ?>
        <?php echo $form->dropDownList($model, 'enumeration_id', CHtml::listData(Enumeration::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'enumeration_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'value'); ?>
        <?php echo $form->textField($model, 'value', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'value'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_default'); ?>
        <?php echo $form->checkbox($model, 'is_default'); ?>
        <?php echo $form->error($model, 'is_default'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->checkbox($model, 'active'); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'order'); ?>
        <?php echo $form->textField($model, 'order', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($model, 'order'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
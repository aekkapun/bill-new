<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'site-phrase-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_id'); ?>
        <?php echo $form->dropDownList($model, 'site_id', CHtml::listData(Site::model()->findAll(), 'id', 'domain')); ?>
        <?php echo $form->error($model, 'site_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phrase'); ?>
        <?php echo $form->textField($model, 'phrase', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'phrase'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'price'); ?>
        <?php echo $form->textField($model, 'price', array('size' => 60)); ?>
        <?php echo $form->error($model, 'price'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'active'); ?>
        <?php echo $form->checkbox($model, 'active'); ?>
        <?php echo $form->error($model, 'active'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
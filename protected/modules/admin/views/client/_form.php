<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'client-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'manager_id'); ?>
        <?php echo $form->dropDownList($model, 'manager_id', CHtml::listData(User::model()->managers()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'manager_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'address'); ?>
        <?php echo $form->textField($model, 'address', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'is_corporate'); ?>
        <?php echo $form->checkbox($model, 'is_corporate'); ?>
        <?php echo $form->error($model, 'is_corporate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'post_code'); ?>
        <?php echo $form->textField($model, 'post_code', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'post_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'code_1c'); ?>
        <?php echo $form->textField($model, 'code_1c', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'code_1c'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', $model->statusLabels); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
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
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
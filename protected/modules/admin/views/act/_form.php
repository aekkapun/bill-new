<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'act-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'client_id'); ?>
        <?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name'), array('empty' => '--выбрать--')); ?>
        <?php echo $form->error($model, 'client_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contract_id'); ?>
        <?php echo $form->dropDownList($model, 'contract_id', CHtml::listData(Contract::model()->my()->findAll(), 'id', 'number'), array('empty' => '--выбрать--')); ?>
        <?php echo $form->error($model, 'contract_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'number'); ?>
        <?php echo $form->textField($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sum'); ?>
        <?php echo $form->textField($model, 'sum', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'sum'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'period'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
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
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, ($model->isNewRecord ? 'file' : 'newFile')); ?>
        <?php echo $form->fileField($model, ($model->isNewRecord ? 'file' : 'newFile')); ?>
        <?php echo $form->error($model, ($model->isNewRecord ? 'file' : 'newFile')); ?>
    </div>

    <?php if (!$model->isNewRecord): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'file'); ?>
        <?php if (!empty($model->file)): ?>
        <?php echo $model->getFile(); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'signed'); ?>
        <?php echo $form->checkbox($model, 'signed'); ?>
        <?php echo $form->error($model, 'signed'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
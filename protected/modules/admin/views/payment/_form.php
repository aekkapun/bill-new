<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'payment-form',
    'enableAjaxValidation' => false,
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
        <?php echo $form->labelEx($model, 'details'); ?>
        <?php echo $form->textArea($model, 'details', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'details'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sum'); ?>
        <?php echo $form->textField($model, 'sum', array('size' => 20, 'maxlength' => 20)); ?>
        <?php echo $form->error($model, 'sum'); ?>
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
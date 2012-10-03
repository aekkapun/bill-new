<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'report-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'client_id'); ?>
        <?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'client_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'period_begin'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $model,
            'attribute' => 'period_begin',
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
            'htmlOptions' => array('value' => (empty($model->period_begin) ? date('Y-m-d') : $model->period_begin)),
        )); ?>
        <?php echo $form->error($model, 'period_begin'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'period_end'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $model,
            'attribute' => 'period_end',
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
            'htmlOptions' => array('value' => (empty($model->period_end) ? date('Y-m-d') : $model->period_end)),
        )); ?>
        <?php echo $form->error($model, 'period_end'); ?>
    </div>

    <?php echo $form->hiddenField($model, 'status', array('value' => Report::STATUS_NEW)) ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'contract_status'); ?>
        <?php echo $form->dropDownList($model, 'contract_status', $model->contractStatusLabel); ?>
        <?php echo $form->error($model, 'contract_status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
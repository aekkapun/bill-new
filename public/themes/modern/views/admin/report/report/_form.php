<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'report-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name'); ?>

<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name'), array(
    'ajax' => array(
        'url' => Yii::app()->createAbsoluteUrl('/admin/report/report/lastPeriodEnd'),
        'data' => array('clientId' => 'js:$(this).val()'),
        'success' => 'js:function(data){ var obj = $("#Report_period_begin"); obj.val(data).prop("disabled", true); }'
    ),
    'prompt' => Yii::app()->params['emptySelectLabel']
)); ?>

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

<?php echo $form->labelEx($model, 'period_end'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $model,
        'attribute' => 'period_end',
        'language' => 'ru',
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy/mm/dd',
            'changeMonth' => true,
            'changeYear' => true,
            'showOn' => 'button',
            'buttonImage' => '/images/calendar.png',
            'buttonImageOnly' => true,
        ),
        'htmlOptions' => array('value' => (empty($model->period_end) ? date('Y-m-d') : $model->period_end)),
    )); ?>

<?php echo $form->hiddenField($model, 'status', array('value' => Report::STATUS_NEW)) ?>

<?php echo $form->dropDownListRow($model, 'contract_status', $model->contractStatusLabel); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>
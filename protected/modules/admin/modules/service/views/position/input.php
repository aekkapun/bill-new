<?php
Yii::app()->clientScript->registerScript('search', "
$('.params-button').click(function(){
	$('.params-block').toggle();
	return false;
});
");
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
)); ?>

    <h1>Текущий услуга
        подключена <?php echo Yii::app()->dateFormatter->format('d MMMM y', $siteService->created_at) ?></h1>

    <?php echo CHtml::link('Текущие параметры', '#', array('class' => 'params-button')); ?>
    <div class="params-block box" style="display: none;">
        <?php $this->renderPartial('_params', array('params' => $params)) ?>
    </div>

    <br />
    <br />

    <?php echo $form->labelEx($positionForm, 'created_at'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $positionForm,
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
        'htmlOptions' => array('value' => date('Y-m-d')),
    )); ?>

    <br /><br />

    <?php foreach ($phrases as $system_id => $system): ?>

    <h2><?php echo $system['name'] ?></h2>

    <?php foreach ($system['phrases'] as $phrase_id => $phrase): ?>

        <div class="row">

            <?php echo $form->errorSummary($phrase); ?>

            <span>Запрос</span>
            <?php echo $form->textField($phrase, '[' . $system_id . $phrase_id . ']phrase', array('readonly' => true, 'value' => $phrase->phrase)) ?>
            <span>Позиция</span>
            <?php echo $form->textField($phrase, '[' . $system_id . $phrase_id . ']position') ?>
        </div>

        <?php echo $form->hiddenField($phrase, '[' . $system_id . $phrase_id . ']system_id', array('value' => $system_id)) ?>
        <?php echo $form->hiddenField($phrase, '[' . $system_id . $phrase_id . ']site_id', array('value' => $site->id)) ?>
        <?php endforeach; ?>

    <?php endforeach; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
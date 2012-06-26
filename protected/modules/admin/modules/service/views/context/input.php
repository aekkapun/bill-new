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

    <div class="row">
        <?php echo $form->labelEx($contextInput, 'created_at'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $contextInput,
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
            'htmlOptions' => array('value' => (empty($contextInput->created_at) ? date('Y-m-d') : $contextInput->created_at)),
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contextInput, 'transitions_count'); ?>
        <?php echo $form->textField($contextInput, 'transitions_count', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($contextInput, 'transitions_count'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contextInput, 'transitions_sum'); ?>
        <?php echo $form->textField($contextInput, 'transitions_sum', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($contextInput, 'transitions_sum'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contextInput, 'adv_platform_id'); ?>
        <?php echo $form->dropDownList($contextInput, 'adv_platform_id', $availableAdvPlatforms); ?>
        <?php echo $form->error($contextInput, 'adv_platform_id'); ?>
    </div>


    <?php echo $form->hiddenField($contextInput, 'site_id', array('value' => $site->id)) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
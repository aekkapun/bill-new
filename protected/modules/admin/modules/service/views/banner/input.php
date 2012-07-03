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
    'id' => 'banner-input-form',
    'enableAjaxValidation' => false,
)); ?>

    <h1>Текущий услуга
        подключена <?php echo Yii::app()->dateFormatter->format('d MMMM y', $siteService->created_at) ?></h1>


    <?php echo CHtml::link('Текущие параметры', '#', array('class' => 'params-button')); ?>
    <div class="params-block box" style="display: none;">
        <?php $this->renderPartial('_params', array('params' => $params)) ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerInput, 'created_at'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $bannerInput,
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
            'htmlOptions' => array('value' => (empty($bannerInput->created_at) ? date('Y-m-d') : $bannerInput->created_at)),
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerInput, 'transitions'); ?>
        <?php echo $form->textField($bannerInput, 'transitions', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($bannerInput, 'transitions'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($bannerInput, 'sum'); ?>
        <?php echo $form->textField($bannerInput, 'sum', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($bannerInput, 'sum'); ?>
    </div>

    <?php echo $form->hiddenField($bannerInput, 'site_id', array('value' => $site->id)) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
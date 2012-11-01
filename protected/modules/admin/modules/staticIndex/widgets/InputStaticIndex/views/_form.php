<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'static-index-input-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'site_id'); ?>
    <?php echo $form->hiddenField($model,'static_index_id'); ?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'input_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'input_date',
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
	</div>

<?php $this->endWidget(); ?>
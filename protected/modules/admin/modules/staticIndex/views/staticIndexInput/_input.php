<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'static-index-input-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value'); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="clearfix">
		<?php echo $form->labelEx($model,'input_date'); ?>
		<?php echo $form->textField($model,'input_date'); ?>
		<?php echo $form->error($model,'input_date'); ?>
	</div>

	<div class="clearfix buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
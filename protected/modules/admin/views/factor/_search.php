<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'system_id'); ?>
		<?php //echo $form->textField($model,'system_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->dropDownList($model,'system_id',
			Factor::$labels,
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<!--
	<div class="row">
		<?php //echo $form->label($model,'created_at'); ?>
		<?php //echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'updated_at'); ?>
		<?php //echo $form->textField($model,'updated_at'); ?>
	</div>
	-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
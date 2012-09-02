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
		<?php echo $form->label($model,'site_id'); ?>
		<?php echo $form->dropDownList($model,'site_id',
			CHtml::listData(Site::model()->findAll(), 'id', 'domain'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'phrase'); ?>
		<?php echo $form->textField($model,'phrase',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>32,'maxlength'=>32)); ?>
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
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-range-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'site_id'); ?>
        <?php echo $form->dropDownList($model, 'site_id', CHtml::listData(Site::model()->findAll(), 'id', 'domain')); ?>
		<?php echo $form->error($model,'site_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valueMin'); ?>
		<?php echo $form->textField($model,'valueMin',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valueMin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valueMax'); ?>
		<?php echo $form->textField($model,'valueMax',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'valueMax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
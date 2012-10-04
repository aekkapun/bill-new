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
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->dropDownList($model, 'name', CHtml::listData(
			Client::model()->my()->findAll(), 'name', 'name'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_corporate'); ?>
		<?php echo $form->dropDownList(
			$model,
			'is_corporate',
			array('1' => 'Да', '0' => 'Нет'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
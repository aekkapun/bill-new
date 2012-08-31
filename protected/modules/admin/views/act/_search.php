<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model, 'client_id'); ?>
        <?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->findAll(), 'id', 'name'), array('empty' => '--выбрать--')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'contract_id'); ?>
        <?php echo $form->dropDownList($model, 'contract_id', CHtml::listData(Contract::model()->findAll(), 'id', 'number'), array('empty' => '--выбрать--')); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sum'); ?>
		<?php echo $form->textField($model,'sum',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signed'); ?>
        <?php echo $form->checkbox($model, 'signed'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
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
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
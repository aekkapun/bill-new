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
		<?php echo $form->label($model,'number'); ?>
		<?php echo $form->textField($model,'number'); ?>
	</div>

	<div class="row">
        <?php echo $form->label($model, 'client_id'); ?>
        <?php echo $form->dropDownList($model, 'client_id', CHtml::listData(
			Client::model()->my()->findAll(), 'id', 'name'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'contract_id'); ?>
		<?php echo $form->dropDownList($model, 'contract_id', CHtml::listData(
			Contract::model()->findAll(), 'id', 'number'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
    </div>
	
	<div class="row">
        <?php echo $form->label($model, 'period'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $model,
            'attribute' => 'period',
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

	<!--
	<div class="row">
		<?php //echo $form->label($model,'created_at'); ?>
		<?php //echo $form->textField($model,'created_at'); ?>
	</div>
	-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
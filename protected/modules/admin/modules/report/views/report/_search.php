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
        <?php echo $form->label($model,'period_begin'); ?>
        <?php echo $form->textField($model,'period_begin'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'period_end'); ?>
        <?php echo $form->textField($model,'period_end'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'client_id'); ?>
        <?php echo $form->textField($model,'client_id',array('size'=>10,'maxlength'=>10)); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->textField($model,'status'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'contract_status'); ?>
        <?php echo $form->textField($model,'contract_status'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'created_at'); ?>
        <?php echo $form->textField($model,'created_at'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'updated_at'); ?>
        <?php echo $form->textField($model,'updated_at'); ?>
    </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Поиск'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
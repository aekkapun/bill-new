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
        <?php echo $form->label($model,'enumeration_id'); ?>
        <?php echo $form->textField($model,'enumeration_id',array('size'=>10,'maxlength'=>10)); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'value'); ?>
        <?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>255)); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'is_default'); ?>
        <?php echo $form->textField($model,'is_default'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'active'); ?>
        <?php echo $form->textField($model,'active'); ?>
    </div>

            <div class="row">
        <?php echo $form->label($model,'order'); ?>
        <?php echo $form->textField($model,'order',array('size'=>10,'maxlength'=>10)); ?>
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
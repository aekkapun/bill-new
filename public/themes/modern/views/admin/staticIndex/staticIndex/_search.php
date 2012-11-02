<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'well'),
)); ?>

    <?php echo $form->errorSummary($model); ?>


    <?php echo $form->label($model,'id'); ?>
    <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>

    <?php echo $form->label($model,'name'); ?>
    <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>

    <?php echo $form->label($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>

    <p>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => ' Поиск')); ?>
    </p>

<?php $this->endWidget(); ?>

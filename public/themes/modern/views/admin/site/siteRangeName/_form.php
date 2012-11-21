<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('size'=>100,'maxlength'=>255, 'class' => 'span6')); ?>

    <?php echo $form->dropDownListRow($model, 'site_id', CHtml::listData(Site::model()->findAll(), 'id', 'domain')); ?>

    <?php echo $form->dropDownListRow($model, 'contract_id', CHtml::listData(Contract::model()->findAll(), 'id', 'number')); ?>

    <p>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
    </p>

<?php $this->endWidget(); ?>
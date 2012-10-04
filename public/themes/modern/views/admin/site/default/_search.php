<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->textFieldRow($model, 'id', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(
        Client::model()->my()->findAll(), 'id', 'name'),
    array('empty' => Yii::app()->params->emptySelectLabel)
); ?>

<?php echo $form->textFieldRow($model, 'domain', array('size' => 60, 'maxlength' => 255)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => ' Поиск')); ?>
</p>

<?php $this->endWidget(); ?>

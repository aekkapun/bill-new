<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->textFieldRow($model, 'id', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'system_id',
    Factor::$labels,
    array('empty' => Yii::app()->params->emptySelectLabel)
); ?>

<?php echo $form->textFieldRow($model, 'position', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'value', array('size' => 5, 'maxlength' => 5)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => ' Поиск')); ?>
</p>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
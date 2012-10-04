<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->textFieldRow($model, 'id', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'valueMin', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'valueMax', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'price', array('size' => 10, 'maxlength' => 10)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => ' Поиск')); ?>
</p>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
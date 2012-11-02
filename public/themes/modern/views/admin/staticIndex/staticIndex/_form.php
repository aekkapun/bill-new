<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

    <p class="label label-important">Поля должны быть уникальными</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'title',array('size'=>100,'maxlength'=>255, 'class' => 'span6')); ?>

    <?php echo $form->textFieldRow($model,'name',array('size'=>100,'maxlength'=>255, 'class' => 'span6')); ?>

    <p>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
    </p>

<?php $this->endWidget(); ?>


<?php $this->widget('application.components.AliasField.AliasField', array(
    'source' => '#StaticIndex_title',
    'destination' => 'StaticIndex_name',
    'separator' => '_',
)); ?>

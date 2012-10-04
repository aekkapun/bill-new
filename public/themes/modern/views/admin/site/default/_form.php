<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'site-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php if ($model->isNewRecord): ?>
<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(Client::model()->my()->findAll(), 'id', 'name')); ?>
<?php else: ?>
<?php echo CHtml::encode($model->client->name) ?>
<?php endif; ?>

<?php echo $form->textFieldRow($model, 'domain', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'region', array('size' => 60, 'maxlength' => 255)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

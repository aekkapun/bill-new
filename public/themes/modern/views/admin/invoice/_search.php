<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->textFieldRow($model, 'id', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'number'); ?>

<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(
        Client::model()->my()->findAll(), 'id', 'name'),
    array('empty' => Yii::app()->params->emptySelectLabel)
); ?>

<?php echo $form->dropDownListRow($model, 'contract_id', Contract::getTogetherIdAndDate(), array(
    'empty' => Yii::app()->params->emptySelectLabel
)); ?>

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
<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => ' Поиск')); ?>
</p>

<?php $this->endWidget(); ?>

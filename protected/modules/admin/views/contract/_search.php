<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'attachments_count'); ?>
        <?php echo $form->dropDownList(
			$model,
			'attachments_count',
			array('1' => 'Да', '0' => 'Нет'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'number'); ?>
        <?php echo $form->textField($model, 'number', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'client_id'); ?>
        <?php echo $form->dropDownList($model, 'client_id',
			CHtml::listData(Client::model()->my()->findAll(), 'id', 'name'),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'status'); ?>
        <?php echo $form->dropDownList(
			$model,
			'status',
			$model->getStatusLabels(),
			array('empty' => Yii::app()->params->emptySelectLabel)
		); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Поиск'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
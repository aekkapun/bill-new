<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
)); ?>

    <h1>Текущий период: с <?php echo $valueStart ?> по <?php echo $valueEnd ?></h1>


    <div class="row">
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $contextInput,
            'attribute' => 'created_at',
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
            'htmlOptions' => array('value' => (empty($contextInput->created_at) ? date('Y-m-d') : $contextInput->created_at)),
        )); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contextInput, 'transitions_count'); ?>
        <?php echo $form->textField($contextInput, 'transitions_count', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($contextInput, 'transitions_count'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contextInput, 'transitions_sum'); ?>
        <?php echo $form->textField($contextInput, 'transitions_sum', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($contextInput, 'transitions_sum'); ?>
    </div>

    <?php echo $form->hiddenField($contextInput, 'site_id', array('value' => $site->id)) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
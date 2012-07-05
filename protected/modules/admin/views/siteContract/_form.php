<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'site-contract-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'site_id'); ?>
        <?php echo $form->dropDownList($model, 'site_id', CHtml::listData($sites, 'id', 'domain'), array('empty' => 'Выбрать')); ?>
        <?php echo $form->error($model, 'site_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'contract_id'); ?>
        <?php echo $form->dropDownList($model, 'contract_id', CHtml::listData($contracts, 'id', 'number'), array('empty' => 'Выбрать')); ?>
        <?php echo $form->error($model, 'contract_id'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'site-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'client_id'); ?>
        <?php if ($model->isNewRecord): ?>
        <?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->findAll(), 'id', 'name'), array(
            'prompt' => 'Выберите клиента',
            /*'ajax' => array(
                'type' => 'POST',
                'dataType' => 'json',
                'url' => Yii::app()->createAbsoluteUrl('/admin/client/ajaxDependsOfClient'),
                'data' => array('id' => 'js:$(this).val()'),
                'success' => 'function(data) {
                $("#Site_siteContracts").html(data.contracts);
            }',)*/
        )); ?>
        <?php echo $form->error($model, 'client_id'); ?>
        <?php else: ?>
        <?php echo CHtml::encode($model->client->name) ?>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'domain'); ?>
        <?php echo $form->textField($model, 'domain', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'domain'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
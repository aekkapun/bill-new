<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'role'); ?>
        <?php echo $form->dropDownList($model, 'role', $model->roleLabels); ?>
        <?php echo $form->error($model, 'role'); ?>
    </div>

    <div class="row" style="display:none;">
        <?php echo $form->labelEx($model, 'client_id'); ?>
        <?php echo $form->dropDownList($model, 'client_id', CHtml::listData(Client::model()->findAll(), 'id', 'name'), array('empty' => '--выбрать--')); ?>
        <?php echo $form->error($model, 'client_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <?php if ($model->isNewRecord): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->textField($model, 'password', array('size' => 32, 'maxlength' => 32)); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <?php else: ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'newPassword'); ?>
        <?php echo $form->textField($model, 'newPassword', array('size' => 32, 'maxlength' => 32)); ?>
        <?php echo $form->error($model, 'newPassword'); ?>
    </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(function () {
        $('#User_password, #User_newPassword').generatePasswordLink('Сгенерировать');

        toggleClientBox($('#User_role'));

        $('#User_role').live('change', function () {
            toggleClientBox($(this));
        });
    });

    function toggleClientBox(obj) {
//        console.log('Ok ' + obj.val().toLowerCase());
        if (obj.val().toLowerCase() == 'client') {
            $('#User_client_id').parent('.row').show();
        } else {
            $('#User_client_id').parent('.row').hide();
        }
    }
</script>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="note">Поля отмеченные звездочкой <span class="required">*</span> обязательны для заполнения.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->dropDownListRow($model, 'role', $model->roleLabels); ?>

<p style="display:none;">
<?php echo $form->dropDownListRow($model, 'client_id', CHtml::listData(Client::model()->findAll(), 'id', 'name'), array('empty' => Yii::app()->params['emptySelectLabel'])); ?>
</p>

<?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>

<?php if ($model->isNewRecord): ?>
<?php echo $form->textFieldRow($model, 'password', array('size' => 32, 'maxlength' => 32)); ?>
<?php else: ?>
<?php echo $form->textFieldRow($model, 'newPassword', array('size' => 32, 'maxlength' => 32)); ?>
<?php endif; ?>

<p>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>


<script type="text/javascript">
    $(function () {
        $('#User_password, #User_newPassword').generatePasswordLink('Сгенерировать');
        toggleClientBox($('#User_role'));
        $('#User_role').live('change', function () {
            toggleClientBox($(this));
        });
    });

    function toggleClientBox(obj) {
        if (obj.val().toLowerCase() == 'client') {
            $('#User_client_id').parent('p').show();
        } else {
            $('#User_client_id').parent('p').hide();
        }
    }
</script>
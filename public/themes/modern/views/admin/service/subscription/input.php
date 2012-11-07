<h1>Ввод данных по услуге</h1>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>

<?php echo $form->labelEx($subscriptionInput, 'created_at'); ?>
<?php $this->widget('application.modules.admin.modules.service.components.LiveService.widgets.LiveServiceDatepickerWidget', array(
    'model' => $subscriptionInput,
    'attribute' => 'created_at',
    'serviceName' => 'subscription',
    'ssId' => $siteService->id,
)); ?>


<?php echo $form->textFieldRow($subscriptionInput, 'link_count', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($subscriptionInput, 'transitions_count', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->hiddenField($subscriptionInput, 'site_id', array('value' => $site->id)) ?>

<?php echo $form->hiddenField($subscriptionInput, 'contract_id', array('value' => $siteService->contract_id)) ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('/shared/_info', array(
    'siteService' => $siteService,
    'site' => $site,
    'params' => isset($params) ? $params : null,
    'service' => isset($service) ? $service : null,
)) ?>
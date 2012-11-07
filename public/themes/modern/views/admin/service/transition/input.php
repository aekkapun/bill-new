<h1>Ввод данных по услуге</h1>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>

<?php echo $form->labelEx($transitions, 'created_at'); ?>
<?php $this->widget('application.modules.admin.modules.service.components.LiveService.widgets.LiveServiceDatepickerWidget', array(
    'model' => $transitions,
    'attribute' => 'created_at',
    'serviceName' => 'transition',
    'ssId' => $siteService->id,
)); ?>

<?php echo $form->textFieldRow($transitions, 'transitions', array('size' => 10, 'maxlength' => 10)); ?>


<?php echo $form->hiddenField($transitions, 'site_id', array('value' => $site->id)) ?>
<?php echo $form->hiddenField($transitions, 'contract_id', array('value' => $siteService->contract_id)) ?>

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
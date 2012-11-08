<h1>Ввод данных по услуге</h1>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'banner-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>
<?php echo $form->labelEx($bannerInput, 'created_at'); ?>
<?php $this->widget('application.modules.admin.modules.service.components.LiveService.widgets.LiveServiceDatepickerWidget', array(
    'model' => $bannerInput,
    'attribute' => 'created_at',
    'serviceName' => 'banner',
    'ssId' => $siteService->id,
)); ?>

<?php echo $form->textFieldRow($bannerInput, 'transitions', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($bannerInput, 'sum', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->hiddenField($bannerInput, 'site_id', array('value' => $site->id)) ?>
<?php echo $form->hiddenField($bannerInput, 'contract_id', array('value' => $siteService->contract_id)) ?>


<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

<?php $this->renderPartial('/shared/_info', array(
    'siteService' => $siteService,
    'site' => $site,
    'params' => $params,
)) ?>
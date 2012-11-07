<h1>Ввод данных по услуге</h1>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>
<?php echo $form->labelEx($positionForm, 'created_at'); ?>
<?php $this->widget('application.modules.admin.modules.service.components.LiveService.widgets.LiveServiceDatepickerWidget', array(
    'model' => $positionForm,
    'attribute' => 'created_at',
    'serviceName' => 'position',
    'ssId' => $siteService->id,
)); ?>

<?php foreach ($phrases as $system_id => $system): ?>

<h2><?php echo $system['name'] ?></h2>

<?php foreach ($system['phrases'] as $phrase_id => $phrase): ?>

    <?php echo $form->errorSummary($phrase); ?>

    <?php echo $form->textFieldRow($phrase, '[' . $system_id . $phrase_id . ']phrase', array('readonly' => true, 'value' => $phrase->phrase)) ?>
    <?php echo $form->textFieldRow($phrase, '[' . $system_id . $phrase_id . ']position') ?>

    <?php echo $form->hiddenField($phrase, '[' . $system_id . $phrase_id . ']system_id', array('value' => $system_id)) ?>
    <?php echo $form->hiddenField($phrase, '[' . $system_id . $phrase_id . ']site_id', array('value' => $site->id)) ?>
    <?php echo $form->hiddenField($phrase, '[' . $system_id . $phrase_id . ']contract_id', array('value' => $siteService->contract_id)) ?>
    <?php endforeach; ?>

<?php endforeach; ?>

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
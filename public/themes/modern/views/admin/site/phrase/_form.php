<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'site-phrase-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->dropDownListRow($model, 'site_id', CHtml::listData(Site::model()->findAll(), 'id', 'domain'), array(
    'ajax' => array(
        'update' => '#SitePhrase_site_phrase_group_id',
        'url' => $this->createUrl('/admin/site/sitePhraseGroup/getGroupsOptions'),
        'data' => 'js:"siteId="+this.value',
        'cache' => false,
    ),
)); ?>

<?php echo $form->textFieldRow($model, 'phrase', array('size' => 60, 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'price', array('size' => 60)); ?>

<?php echo $form->dropDownListRow($model, 'site_phrase_group_id', SitePhraseGroup::getGroupsBySiteId( $model->site_id )); ?>

<?php echo $form->checkboxRow($model, 'active'); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>

</div><!-- form -->
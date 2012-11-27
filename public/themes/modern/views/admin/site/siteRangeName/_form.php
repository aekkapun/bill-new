<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('size'=>100,'maxlength'=>255, 'class' => 'span6')); ?>

    <?php echo $form->dropDownListRow($model, 'site_id', CHtml::listData(Site::model()->findAll(), 'id', 'domain'), array(
        'ajax' => array(
            'update' => '#SiteRangeName_site_phrase_group_id',
            'url' => $this->createUrl('/admin/site/sitePhraseGroup/getGroupsOptions'),
            'data' => 'js:"siteId="+this.value',
            'cache' => false,
        ),
    )); ?>

    <?php echo $form->dropDownListRow($model, 'contract_id', CHtml::listData(Contract::model()->findAll(), 'id', 'number')); ?>

    <?php echo $form->dropDownListRow($model, 'site_phrase_group_id', SitePhraseGroup::getGroupsBySiteId( $model->site_id )); ?>

    <p>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
    </p>

<?php $this->endWidget(); ?>
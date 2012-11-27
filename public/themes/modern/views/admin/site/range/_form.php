<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'site-range-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<?php echo $form->dropDownListRow($model, 'site_id', CHtml::listData(Site::model()->findAll(), 'id', 'domain'), array(
    'ajax' => array(
        'update' => '#SiteRange_site_range_name_id',
        'url' => $this->createUrl('/admin/site/siteRangeName/getNamesOptions'),
        'data' => 'js:"siteId="+this.value',
        'cache' => false,
    ),
)); ?>


<?php echo $form->textFieldRow($model, 'valueMin', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($model, 'valueMax', array('size' => 10, 'maxlength' => 10)); ?>
<span class="help-block">Если верхнее ограничение не требуется, введите цифру 0</span>

<?php echo $form->dropDownListRow($model, 'site_range_name_id', SiteRangeName::getNamesBySiteId( $model->site_id )); ?>

<?php echo $form->textFieldRow($model, 'price', array('size' => 10, 'maxlength' => 10)); ?>

<p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Сохранить')); ?>
</p>

<?php $this->endWidget(); ?>
<h1>Ввод данных по услуге</h1>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>
<?php echo $form->labelEx($subscriptionInput, 'created_at'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
    array(
        'model' => $subscriptionInput,
        'attribute' => 'created_at',
        'language' => 'ru',
        'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd',
            'changeMonth' => true,
            'changeYear' => true,
            'showOn' => 'button',
            'buttonImage' => '/images/calendar.png',
            'buttonImageOnly' => true,
            'beforeShowDay' => 'js:highlight'
        ),
        'htmlOptions' => array('value' => (empty($subscriptionInput->created_at) ? date('Y-m-d') : $subscriptionInput->created_at)),
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


<style type="text/css">
    td.yeah a.ui-state-default {
        background: yellow;
    }
</style>

<script type="text/javascript">

    var filledDays = [];

    $.get('/admin/service/subscription/getFilledDays', {siteId : 2})
    .success(function(data) {

        console.log( data );
        filledDays = eval( data );
        console.log( filledDays );
    });

    function highlight(date) {

        formattedDate = $.datepicker.formatDate('yy-mm-dd', date);;
        return (filledDays.indexOf(formattedDate) > -1) ? [true, 'yeah'] : [true];
    }
</script>
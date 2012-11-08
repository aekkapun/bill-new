<h1>Ввод данных по услуге</h1>

<?php $this->widget('bootstrap.widgets.TbAlert'); ?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'position-input-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'well well-small'),
)); ?>

<?php echo $form->labelEx($contextInput, 'created_at'); ?>
<?php $this->widget('application.modules.admin.modules.service.components.LiveService.widgets.LiveServiceDatepickerWidget', array(
    'model' => $contextInput,
    'attribute' => 'created_at',
    'serviceName' => 'context',
    'ssId' => $siteService->id,
)); ?>

<?php echo $form->textFieldRow($contextInput, 'transitions_count', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->textFieldRow($contextInput, 'transitions_sum', array('size' => 10, 'maxlength' => 10)); ?>

<?php echo $form->dropDownListRow($contextInput, 'adv_platform_id', $availableAdvPlatforms); ?>


<?php echo $form->hiddenField($contextInput, 'site_id', array('value' => $site->id)) ?>
<?php echo $form->hiddenField($contextInput, 'contract_id', array('value' => $siteService->contract_id)) ?>

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


<script type="text/javascript">

    $(function(){
        currentDate = $('#ContextInput_created_at').val();
        liveService.getDataByDate(currentDate);
        liveService.updateContextFields();
    });


    // Update fields on change adv platform_id
    $('#ContextInput_adv_platform_id').change(function(){
        liveService.updateContextFields( );
    });


    liveService.contextData = {};


    liveService.getDataByDate = function( date )
    {
        $.get(liveService.getDataByDateUrl, {ssId : liveService.ssId, date : date})
        .success(function(data) {

            response = $.parseJSON(data);

            liveService.contextData = response.data;

            liveService.updateContextFields();
        });
    }


    liveService.updateContextFields = function()
    {
        advPlatformId = $('#ContextInput_adv_platform_id').val();

        if( !$.isEmptyObject(liveService.contextData[advPlatformId]) )
        {
            $('#ContextInput_transitions_count').val( liveService.contextData[advPlatformId].transitions_count );
            $('#ContextInput_transitions_sum').val( liveService.contextData[advPlatformId].transitions_sum );
        }
        else
        {
            $('#ContextInput_transitions_count').val( '' );
            $('#ContextInput_transitions_sum').val( '' );
        }
    }

</script>
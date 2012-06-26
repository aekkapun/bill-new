<h1>Добавление услуги</h1>

<dl>
    <dt>Название:</dt>
    <dd><?php echo CHtml::encode($service->name) ?></dd>

    <dt>Сайт:</dt>
    <dd><?php echo CHtml::encode($site->domain) ?></dd>
</dl>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'position-subscribe-form',
    'enableAjaxValidation' => false,
)); ?>

    <div class="row">
        <?php echo $form->labelEx($siteService, 'contract_id'); ?>
        <?php echo $form->dropDownList($siteService, 'contract_id', CHtml::listData(Contract::model()->findAllByAttributes(array('client_id' => $site->client->id)), 'id', 'number')) ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($siteService, 'created_at'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'model' => $siteService,
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
            ),
        )); ?>
        <?php echo $form->error($siteService, 'created_at'); ?>
    </div>

    <h2>Верхнее ограничение</h2>

    <?php echo $form->errorSummary($transitionForm); ?>

    <div class="row">
        <?php echo $form->labelEx($transitionForm, 'sumMax'); ?>
        <?php echo $form->textField($transitionForm, 'sumMax', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($transitionForm, 'sumMax'); ?>
    </div>


    <h2>Диапазоны</h2>

    <?php echo $form->errorSummary($ranges); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($ranges),
        'filter' => null,
        'template' => '{items}',
        'columns' => array(
            array(
                'header' => 'Min',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]valueMin", array("readonly" => true))',
            ),
            array(
                'header' => 'Max',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]valueMax", array("readonly" => true))',
            ),
            array(
                'header' => 'Цена за переход',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]price", array("readonly" => true))',
            ),

        ),
    ));
    ?>

    <?php echo CHtml::activeHiddenField($siteService, 'site_id', array('value' => $site->id)) ?>
    <?php echo CHtml::activeHiddenField($siteService, 'service_id', array('value' => $service->id)) ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Добавить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
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

    <h2>Коэффициенты</h2>

    <?php echo $form->errorSummary($factors); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($factors),
        'filter' => null,
        'template' => '{items}',
        'columns' => array(
            array(
                'header' => 'Название',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]name")',
            ),
            array(
                'header' => 'Значение коэффициента',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]value")',
            ),
        ),
    ));
    ?>

    <h2>Запросы</h2>

    <?php echo $form->errorSummary($phrases); ?>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($phrases),
        'filter' => null,
        'template' => "{pager}<br>{items}<br>{pager}",
        'columns' => array(
            array(
                'header' => 'Запрос',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]phrase")',
            ),
            array(
                'header' => 'Стоимость',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]price")',
            ),

            array(
                'header' => 'Контрольная сумма',
                'type' => 'raw',
                'value' => 'CHtml::activeTextField($data, "[".$data->id."]hash", array("readonly" => true))',
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
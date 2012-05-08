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

    <?php echo $form->errorSummary($contextForm); ?>

    <div class="row">
        <?php echo $form->labelEx($contextForm, 'budget'); ?>
        <?php echo $form->textField($contextForm, 'budget', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($contextForm, 'budget'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($contextForm, 'workPercent'); ?>
        <?php echo $form->textField($contextForm, 'workPercent', array('size' => 10, 'maxlength' => 10)); ?>
        <?php echo $form->error($contextForm, 'workPercent'); ?>
        <p class="hint">Например: 0.01=1%, 0.25=25%, 1=100%</p>
    </div>


    <h2>Рекламные площадки</h2>

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => new CArrayDataProvider($advPlatforms),
        'filter' => null,
        'template' => '{items}',
        'selectableRows' => 2,
        'columns' => array(
            array(
                'class' => 'CCheckBoxColumn',
                'id' => 'advPlatforms',
            ),
            'name:Название',
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
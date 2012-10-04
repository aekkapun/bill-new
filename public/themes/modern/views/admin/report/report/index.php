<?php
$this->breadcrumbs = array(
    'Отчеты' => array('index'),
    'Список',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "

    setInterval(function(){ $.fn.yiiGridView.update('report-grid') }, 5000);

    $('.search-button').click(function(){
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('report-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
?>

<h1>Отчеты</h1>

<div class="search-form">
    <?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'report-grid',
    'dataProvider' => $model->search(),
    'filter' => null,
    'columns' => array(
        'id',
        array(
            'type' => 'raw',
            'name' => 'name',
            'value' => 'CHtml::link($data->name, array("/admin/report/report/view", "id" => $data->id))'
        ),
        array(
            'type' => 'date',
            'name' => 'period_begin',
            'value' => 'strtotime($data->period_begin)',
        ),
        array(
            'type' => 'date',
            'name' => 'period_end',
            'value' => 'strtotime($data->period_end)',
        ),
        array(
            'name' => 'client.name',
            'type' => 'raw',
            'value' => 'CHtml::link($data->client->name, array("/admin/client/view", "id" => $data->client->id))',
        ),
        array(
            'type' => 'raw',
            'name' => 'status',
            'value' => '$data->getStatusLabel()'
        ),
        array(
            'type' => 'raw',
            'name' => 'contract_status',
            'value' => '$data->getContractStatusLabel()'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {delete}',
            'buttons' => array(
                'delete' => array(
                    'visible' => 'false',
                ),
            ),
        ),
    ),
)); ?>

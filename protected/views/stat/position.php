<?php
$this->breadcrumbs = array(
    'Статистика',
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'stat-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => 'CHtml::link($data->period_name, array("/detail/" . Service::getControllerName(Service::POSITION), "siteId" => $data->site_id, "from" => strtotime($data->period_begin), "to" => strtotime($data->period_end)))'
        ),
        'sum',
    ),
)); ?>
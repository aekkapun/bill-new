<?php
$this->breadcrumbs = array(
    'Акты' => array('index'),
    'Список',
);
?>

<h1>Акты</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'act-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'contract.number',
        'sum',
        array(
            'type' => 'date',
            'value' => 'strtotime($data->created_at)'
        ),
        array(
            'header' => 'Подписан?',
            'type' => 'boolean',
            'name' => 'signed',
        ),
    ),
)); ?>

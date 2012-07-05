<?php
$this->breadcrumbs = array(
    'Платежи' => array('index'),
    'Список',
);
?>

<h1>Платежи</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'payment-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'contract.number',
        'details',
        'sum',
        array(
            'type' => 'date',
            'value' => 'strtotime($data->created_at)'
        ),
    ),
)); ?>

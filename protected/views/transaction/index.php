<?php
$this->breadcrumbs = array(
    'Транзакции' => array('index'),
    'Список',
);
?>

<h1>Транзакции</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'transaction-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'id',
		'contract.number',
		'details',
        'sum',
        'type',
        array(
            'type' => 'date',
            'value' => 'strtotime($data->created_at)'
        ),
    ),
)); ?>

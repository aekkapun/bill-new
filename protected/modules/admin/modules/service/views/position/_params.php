<h3>Запросы</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'position-service-params-grid-phrases',
    'dataProvider' => new CArrayDataProvider($params['phrases']),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'phrase',
        'price',
    ),
)); ?>

<h3>Коэффициенты</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'position-service-params-grid-factors',
    'dataProvider' => new CArrayDataProvider($params['factors']),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'name',
        'value',
    ),
)); ?>
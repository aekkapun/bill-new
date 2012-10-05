<h3>Запросы</h3>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'position-service-params-grid-phrases',
    'dataProvider' => new CArrayDataProvider($params['phrases']),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'phrase:Запрос',
        'price:Цена',
    ),
)); ?>

<h3>Коэффициенты</h3>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'position-service-params-grid-factors',
    'dataProvider' => new CArrayDataProvider($params['factors']),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'name:Название',
        'value:Значение',
    ),
)); ?>
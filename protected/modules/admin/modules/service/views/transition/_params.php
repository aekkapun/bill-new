<h3>Верхнее ограничение: <?php echo $params['maxSum'] ?></h3>

<h3>Диапазоны</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'transition-service-params-grid-ranges',
    'dataProvider' => new CArrayDataProvider($params['ranges']),
    'filter' => null,
    'template' => '{items}',
    'columns' => array(
        'valueMin:Мин',
        'valueMax:Макс',
        'price:Цена'
    ),
)); ?>
<?php if(isset($params['maxSum'])) : ?>
<h3>Верхнее ограничение: <?php echo $params['maxSum'] ?></h3>
<?php endif; ?>

<?php if(isset($params['ranges'])) : ?>
<h3>Диапазоны</h3>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
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
<?php endif; ?>
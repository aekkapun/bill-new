<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'static-index-grid',
    'dataProvider' => $dataProvider,
    'template' => '{items}<br/>{pager}',
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Показатель',
            'name' => 'index',
        ),
        array(
            'header' => 'Дата показателя',
            'name' => 'inputDate',
        ),
        array(
            'header' => 'Текущее значение',
            'name' => 'currentValue',
        ),
        array(
            'header' => 'Предыдущее значение',
            'name' => 'lastValue',
        ),
        array(
            'type' => 'raw',
            'header' => '',
            'name' => 'inputButton',
        ),
    ),
));
?>

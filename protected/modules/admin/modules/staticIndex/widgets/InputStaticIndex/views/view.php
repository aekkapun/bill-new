<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'static-index-grid',
    'dataProvider' => $dataProvider,
    'template' => '{items}<br/>{pager}',
    'rowCssClassExpression' => '$data["name"]',
    'filter' => null,
    'columns' => array(
        array(
            'header' => 'Показатель',
            'name' => 'title',
        ),
        array(
            'header' => 'Дата показателя',
            'name' => 'inputDate',
            'htmlOptions' => array('class' => 'inputDate'),
        ),
        array(
            'header' => 'Текущее значение',
            'name' => 'currentValue',
            'htmlOptions' => array('class' => 'currentValue'),
        ),
        array(
            'header' => 'Предыдущее значение',
            'name' => 'lastValue',
            'htmlOptions' => array('class' => 'lastValue'),
        ),
        array(
            'type' => 'raw',
            'header' => '',
            'name' => 'inputButton',
        ),
    ),
));
?>
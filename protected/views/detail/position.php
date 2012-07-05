<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'stat-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'columns' => array(
        array(
            'type' => 'raw',
            'value' => 'Yii::app()->dateFormatter->format("d MMMM y", strtotime($data->created_at))'
        ),
        'phrase',
        'position',
        array(
            'type' => 'text',
            'value' => 'Factor::getLabel($data->system_id)'
        ),
        array(
            'name' => 'price',
            'type' => 'number',
            'footer' => "Всего: " . $totalSum
        ),
    ),
)); ?>
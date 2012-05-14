<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'stat-grid',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'columns' => array(
        'period_begin',
        'period_end',
        'transition_count',
        'transition_sum'
    ),
)); ?>
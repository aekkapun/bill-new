<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-log-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'user',
        'contract.number',
        'action:html',
        'updated_at',
    ),
)); ?>
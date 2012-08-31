<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 8/31/12
 * Time: 3:15 PM
 * To change this template use File | Settings | File Templates.
 */


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-range-grid',
    'dataProvider' => new CArrayDataProvider($model->siteRanges),
    'filter' => null,
    'columns' => array(
        'valueMin:Мин',
        'valueMax:Макс',
        'price:Цена',
    ),
));
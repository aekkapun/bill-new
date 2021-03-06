<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 8/31/12
 * Time: 3:15 PM
 * To change this template use File | Settings | File Templates.
 */

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'site-range-sub-grid',
    'dataProvider' => new CArrayDataProvider($model->siteRanges, array(
		'sort' => array(
			'attributes' => array('valueMin', 'valueMax', 'price'),
		),
        'pagination' => array(
            'pageSize' => 20,
        ),
	)),
	'filter' => null,
    'columns' => array(
        'valueMin:Мин',
        'valueMax:Макс',
        'price:Цена',
    ),
));
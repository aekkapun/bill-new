<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 8/31/12
 * Time: 3:13 PM
 * To change this template use File | Settings | File Templates.
 */

$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'id' => 'site-phrase-sub-grid',
    'dataProvider' => new CArrayDataProvider($model->sitePhrases, array(
		'sort' => array(
			'attributes' => array('phrase', 'price', 'active'),
		),
        'pagination' => array(
            'pageSize' => 20,
        ),
	)),
    'filter' => null,
    'columns' => array(
        'phrase:Запрос',
		'price:Цена',
        'active:boolean:Активен?'
    ),
));
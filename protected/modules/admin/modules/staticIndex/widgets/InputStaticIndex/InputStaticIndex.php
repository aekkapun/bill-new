<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 30.10.12
 * Time: 10:33
 */
class InputStaticIndex extends CWidget
{

    public $siteId;

    private $_dataProvider;




    public function init()
    {
        Yii::import('application.modules.admin.modules.staticIndex.models.*');

        $indexes = $this->_generateIndexes();

        $this->_generateDataProvider( $indexes );
    }


    public function run()
    {
        $this->render('view', array('dataProvider' => $this->_dataProvider));
    }


    private function _generateDataProvider( $indexes )
    {
        $fields = array();

        foreach( StaticIndex::model()->findAll() as $model )
        {
            $fields[] = array(
                'name'         => $model->name,
                'index'        => $model->title,
                'date'         => $indexes[$model->name]['date'],
                'currentValue' => $indexes[$model->name]['currentValue'],
                'lastValue'    => $indexes[$model->name]['lastValue'],
                'inputButton'  => $this->_generateInputButton(),
            );
        }

        $this->_dataProvider = new CArrayDataProvider( $fields );
    }


    private function _generateIndexes()
    {
        $indexes = StaticIndexInput::getIndexes( $this->siteId );

        return array(
            'tic' => array(
                'date' => '01.01.2001',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
            'pr' => array(
                'date' => '01.01.2002',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
            'pages_in_yandex' => array(
                'date' => '01.01.2003',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
            'pages_in_google' => array(
                'date' => '01.01.2004',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
            'total_view_counts' => array(
                'date' => '01.01.2005',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
            'avg_uniq_users_count_per_month' => array(
                'date' => '01.01.2005',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
            'avg_view_depth' => array(
                'date' => '01.01.2007',
                'currentValue' => '500',
                'lastValue' => '450',
            ),
        );
    }



    private function _generateInputButton()
    {
        $button = CHtml::tag(
            'button',
            array('class' => 'btn btn-mini'),
            '<i class="icon-pencil"></i>'
        );

        return $button;
    }


    /*

    select id, v.id

	(select
		`value`
	from
		static_index_input v
	where
		v.static_index_id = s.id
	limit 1) as q

from static_index as s

(select
	static_index_id, input_date, value
from
	static_index_input
where
	site_id = 1
	and
	static_index_id = 1
order by
	input_date DESC
limit 1) as q


     */

}

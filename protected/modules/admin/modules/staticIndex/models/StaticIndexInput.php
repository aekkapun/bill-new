<?php

/**
* @property string $id
* @property string $site_id
* @property string $static_index_id
* @property integer $value
* @property string $input_date
* @property string $created_at
* @property string $updated_at
*
* @property StaticIndex $staticIndex
* @property Site $site
*/

class StaticIndexInput extends CActiveRecord
{

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public function tableName()
    {
        return 'static_index_input';
    }


    public function init()
    {
        $this->input_date = date('Y-m-d');
    }


    public function rules()
    {
        return array(
            array('created_at, updated_at', 'safe'),
            array('id, site_id, static_index_id, value, input_date, created_at, updated_at', 'safe', 'on'=>'search'),

            // Value
            array('value', 'required'),
            array('value', 'numerical', 'integerOnly' => true),
            array('value', 'length', 'max' => 10),

            // Input date
            array('input_date', 'required'),
            array('input_date', 'date', 'format' => 'yyyy-MM-dd'),

            // Site id
            array('site_id', 'required'),
            array('site_id', 'exist', 'className' => 'Site', 'attributeName' => 'id'),

            // Static index id
            array('static_index_id', 'required'),
            array('static_index_id', 'exist', 'className' => 'StaticIndex', 'attributeName' => 'id'),
        );



    }


    public function relations()
    {
        return array(
            'staticIndex' => array(self::BELONGS_TO, 'StaticIndex', 'static_index_id'),
            'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'site_id' => 'Site',
            'static_index_id' => 'Static Index',
            'value' => 'Значение',
            'input_date' => 'Дата',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        );
    }


    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
                'setUpdateOnCreate' => true
            )
        );
    }


    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id,true);
        $criteria->compare('site_id',$this->site_id,true);
        $criteria->compare('static_index_id',$this->static_index_id,true);
        $criteria->compare('value',$this->value);
        $criteria->compare('input_date',$this->input_date,true);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('updated_at',$this->updated_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    public function getName()
    {
        return $this->staticIndex->name;
    }


    /**
     * Returns array, contains index info
     *
     *  array(
     *      'tic' => array(
     *          'inputDate' => '01.01.2001',
     *          'currentValue' => '500',
     *          'lastValue' => '450',
     *      ),
     *      'pr' => array(
     *          'inputDate' => '01.01.2002',
     *          'currentValue' => '500',
     *          'lastValue' => '450',
     *      ),
     *      ...
     *      'pages_in_yandex' => array(
     *          'inputDate' => '01.01.2003',
     *          'currentValue' => '500',
     *          'lastValue' => '450',
     *      ),
     *  );
     *
     */
    public static function getIndexes( $siteId, $emptyValue='-' )
    {
        $fields = StaticIndex::model()->findAll();

        $indexes = array();

        foreach( $fields as $field )
        {
            $indexes[$field->name] = self::getIndex( $siteId, $field->name, $emptyValue );
        }

        return $indexes;
    }


    /**
     * Returns array, contains index info
     *
     *  array(
     *      'inputDate' => '01.01.2001',
     *      'currentValue' => '500',
     *      'lastValue' => '450',
     *  );
     *
     */
    public static function getIndex( $siteId, $indexName, $emptyValue='-' )
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'input_date DESC';
        $criteria->limit = 2;
        $criteria->join = 'JOIN static_index b ON t.static_index_id = b.id';
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
            'b.name' => $indexName,
        ));
        $criteria->order = 'input_date DESC, t.created_at DESC';

        $models = self::model()->findAll( $criteria );


        if( !count($models) )
        {
            return array(
                'inputDate'    => $emptyValue,
                'currentValue' => $emptyValue,
                'lastValue'    => $emptyValue,
            );
        }

        $currentModel = $models[0];
        $lastModel = isset($models[1]) ? $models[1] : null;

        $date = isset($currentModel->input_date) ? date( 'd.m.Y', strtotime($currentModel->input_date)) : $emptyValue;
        $currentValue = isset($currentModel->value) ? $currentModel->value : $emptyValue;
        $lastValue = isset($lastModel->value) ? $lastModel->value : $emptyValue;

        return array(
            'inputDate'    => $date,
            'currentValue' => $currentValue,
            'lastValue'    => $lastValue,
        );
    }
}
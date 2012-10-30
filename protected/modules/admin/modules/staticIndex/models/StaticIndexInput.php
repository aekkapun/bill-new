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


    public function rules()
    {
        return array(
            array('site_id, static_index_id, value, input_date', 'required'),
            array('value', 'numerical', 'integerOnly'=>true),
            array('site_id, static_index_id', 'length', 'max'=>10),
            array('created_at, updated_at', 'safe'),
            array('id, site_id, static_index_id, value, input_date, created_at, updated_at', 'safe', 'on'=>'search'),
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
            'value' => 'Value',
            'input_date' => 'Input Date',
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
     */
    public static function getIndexes( $siteId )
    {
        $fields = StaticIndex::model()->findAll();

        $indexes = array();

        foreach( $fields as $field )
        {
            $criteria = new CDbCriteria;
            $criteria->addColumnCondition(array(
                'site_id' => $siteId,
                'static_index_id' => $field->id,
            ));
            $criteria->order = 'input_date DESC';

            $index = self::model()->find( $criteria );

            $indexes[$index->name] = array(
                'inputDate' => $index->input_date,
                'currentValue' => $index->value,
                'lastValue' => $index->value,
            );
        }


        return $indexes;
    }
}
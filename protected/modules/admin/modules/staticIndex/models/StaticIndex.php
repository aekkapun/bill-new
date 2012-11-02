<?php

/**
* @property string $id
* @property string $name
* @property string $title
* @property string $created_at
* @property string $updated_at
*
* @property StaticIndexInput[] $staticIndexInputs
*/

class StaticIndex extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public function tableName()
    {
        return 'static_index';
    }


    public function rules()
    {
        return array(
            array('name, title', 'required'),
            array('name, title', 'length', 'max'=>255),

            array('name', 'match', 'pattern' => '/^[_a-z0-9]+$/'),

            array('id, name, title, created_at, updated_at', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
            'staticIndexInputs' => array(self::HAS_MANY, 'StaticIndexInput', 'static_index_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => '#',
            'title' => 'Название',
            'name' => 'Имя индекса в БД',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('updated_at',$this->updated_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}
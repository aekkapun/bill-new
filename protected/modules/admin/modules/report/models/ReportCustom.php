<?php

/**
* This is the model class for table "report_custom".
*
* The followings are the available columns in table 'report_custom':
* @property string $id
* @property integer $report_id
* @property integer $site_id
* @property string $name
* @property string $price
* @property string $created_at
* @property string $updated_at
*/
class ReportCustom extends CActiveRecord
{
/**
* Returns the static model of the specified AR class.
* @return ReportCustom the static model class
*/
public static function model($className=__CLASS__)
{
return parent::model($className);
}

/**
* @return string the associated database table name
*/
public function tableName()
{
return 'report_custom';
}

/**
* @return array validation rules for model attributes.
*/
public function rules()
{
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
return array(
array('report_id, site_id', 'numerical', 'integerOnly'=>true),
array('name', 'length', 'max'=>255),
array('price', 'length', 'max'=>20),
array('created_at, updated_at', 'safe'),
// The following rule is used by search().
// Please remove those attributes that should not be searched.
array('id, report_id, site_id, name, price, created_at, updated_at', 'safe', 'on'=>'search'),
);
}

/**
* @return array relational rules.
*/
public function relations()
{
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
return array(
);
}

/**
* @return array customized attribute labels (name=>label)
*/
public function attributeLabels()
{
return array(
'id' => 'ID',
'report_id' => 'Report',
'site_id' => 'Site',
'name' => 'Name',
'price' => 'Price',
'created_at' => 'Created At',
'updated_at' => 'Updated At',
);
}

/**
* @return array behaviors.
*/
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

/**
* Retrieves a list of models based on the current search/filter conditions.
* @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
*/
public function search()
{
// Warning: Please modify the following code to remove attributes that
// should not be searched.

$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('report_id',$this->report_id);
		$criteria->compare('site_id',$this->site_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

return new CActiveDataProvider($this, array(
'criteria'=>$criteria,
));
}

    /**
     * Return array, contains all sites id from table
     *
     *      return Array
     *          [1] => Array
     *          (
     *              [name] => http://test.ru
     *          )
     *
     *          [2] => Array
     *          (
     *              [name] => http://habrahabr.ru
     *          )
     *      )
     *
     * 'name' - it is ALIAS for 'site_id'
     * It is need for TbGroupedGridView
     *
     */
    public static function getSectionData()
    {
        $data = self::model()->findAll(array(
            'select' => 'site_id',
            'group' => 'site_id',
        ));

        if( empty($data) )
        {
            return array();
        }


        $sectionData = array();

        foreach( $data as $item )
        {
            $site = Site::model()->findByPk($item->site_id)->domain;

            $sectionData[$item->site_id] = array(
                'name' => $site,
            );
        }

        return $sectionData;
    }


    /**
     * Returns total balance
     *
     *  return 321554;
     */
    public static function getBalance($reportId)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'sum(price) as price';
        $criteria->condition = 'report_id = :report_id';
        $criteria->params = array(':report_id' => $reportId);

        $balance = self::model()->find($criteria)->price;

        return $balance;
    }

}
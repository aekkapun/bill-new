<?php

/**
 * This is the model class for table "site_range".
 *
 * The followings are the available columns in table 'site_range':
 * @property string $id
 * @property string $site_id
 * @property string $valueMin
 * @property string $valueMax
 * @property string $price
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Site $site
 */
class SiteRange extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SiteRange the static model class
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
		return 'site_range';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id, price', 'required'),
			array('site_id, valueMin, valueMax, price', 'length', 'max'=>10),
            array('valueMin, valueMax', 'numerical'),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, site_id, valueMin, valueMax, price, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'site_id' => 'Site',
			'valueMin' => 'Value Min',
			'valueMax' => 'Value Max',
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
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('valueMin',$this->valueMin,true);
		$criteria->compare('valueMax',$this->valueMax,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
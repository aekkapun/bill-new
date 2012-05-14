<?php

/**
 * This is the model class for table "subscription_period".
 *
 * The followings are the available columns in table 'subscription_period':
 * @property string $id
 * @property string $site_id
 * @property string $period_begin
 * @property string $period_end
 * @property string $avg_link_price
 * @property string $created_at
 * @property string $updated_at
 */
class SubscriptionPeriod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SubscriptionPeriod the static model class
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
		return 'subscription_period';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id', 'required'),
			array('site_id, avg_link_price', 'length', 'max'=>10),
			array('period_begin, period_end, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, site_id, period_begin, period_end, avg_link_price, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'site_id' => 'Site',
			'period_begin' => 'Period Begin',
			'period_end' => 'Period End',
			'avg_link_price' => 'Avg Link Price',
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
		$criteria->compare('period_begin',$this->period_begin,true);
		$criteria->compare('period_end',$this->period_end,true);
		$criteria->compare('avg_link_price',$this->avg_link_price,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
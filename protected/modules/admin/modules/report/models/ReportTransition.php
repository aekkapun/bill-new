<?php

/**
 * This is the model class for table "report_transition".
 *
 * The followings are the available columns in table 'report_transition':
 * @property string $id
 * @property integer $report_id
 * @property integer $site_id
 * @property integer $contract_id
 * @property integer $transition_count
 * @property integer $transition_price
 * @property integer $transition_sum
 * @property integer $site_range_name_id
 * @property string $created_at
 * @property string $updated_at
 */
class ReportTransition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportTransition the static model class
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
		return 'report_transition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_id, site_id, contract_id, transition_count, transition_price, transition_sum, site_range_name_id', 'numerical', 'integerOnly'=>true),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, report_id, site_id, contract_id, transition_count, transition_price, transition_sum, site_range_name_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'contract_id' => 'Contract',
			'transition_count' => 'Transition Count',
			'transition_price' => 'Transition Price',
			'transition_sum' => 'Transition Sum',
			'site_range_name_id' => 'Site Range Name',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('contract_id',$this->contract_id);
		$criteria->compare('transition_count',$this->transition_count);
		$criteria->compare('transition_price',$this->transition_price);
		$criteria->compare('transition_sum',$this->transition_sum);
		$criteria->compare('site_range_name_id',$this->site_range_name_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
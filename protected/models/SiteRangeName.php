<?php

/**
 * This is the model class for table "range_name".
 *
 * The followings are the available columns in table 'range_name':
 * @property string $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $site_id
 * @property string $contract_id
 *
 * The followings are the available model relations:
 * @property SiteRange[] $siteRanges
 */
class SiteRangeName extends CActiveRecord
{
    const DEFAULT_NAME_ID = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteRangeName the static model class
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
		return 'site_range_name';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),

            array('site_id', 'exist', 'className' => 'Site', 'attributeName' => 'id'),
            array('contract_id', 'exist', 'className' => 'Contract', 'attributeName' => 'id'),

            array('id, name, created_at, updated_at, site_id, contract_id', 'safe', 'on'=>'search'),
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
			'siteRanges' => array(self::HAS_MANY, 'SiteRange', 'site_range_name_id'),
            'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'name' => 'Название',
			'site_id' => 'Сайт',
			'contract_id' => 'Договор',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('site_id',$this->site_id);
		$criteria->compare('contract_id',$this->contract_id);
        $criteria->with = array('site');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'attributes' => array(
                    'site.domain' => array(
                        'asc' => 'site.domain ASC',
                        'desc' => 'site.domain DESC',
                    ),
                    'contract.number' => array(
                        'asc' => 'contract.number ASC',
                        'desc' => 'contract.number DESC',
                    ),
                    '*',
                ),
            ),
		));
	}
}
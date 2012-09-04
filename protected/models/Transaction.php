<?php

/**
 * This is the model class for table "transaction".
 *
 * The followings are the available columns in table 'transaction':
 * @property string $id
 * @property string $contract_id
 * @property string $details
 * @property string $sum
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Contract $contract
 */
class Transaction extends CActiveRecord
{
    const TYPE_CREDIT = 1;
    const TYPE_DEBIT = 2;
	
	public static $labels = array(
		self::TYPE_CREDIT => 'Зачисление',
		self::TYPE_DEBIT => 'Списание',
	);
	
	/**
     * Returns the static model of the specified AR class.
     * @return Transaction the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	/**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'transaction';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, contract_id, sum', 'required'),
            array('contract_id', 'length', 'max' => 10),
            array('type', 'length', 'max' => 1),
            array('type', 'in', 'range' => array_keys(self::$labels)),
            array('sum', 'length', 'max' => 20),
            array('details, created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, type, contract_id, details, sum, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'contract_id' => 'Номер договора',
            'details' => 'Назначение/комментарий',
            'sum' => 'Сумма',
            'type' => 'Тип операции',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
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
                'createAttribute' => null,
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

        $criteria = new CDbCriteria;

		$criteria->with = array( 'contract' );
        $criteria->compare('t.id', $this->id);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('sum', $this->sum);
        $criteria->compare('type', $this->type);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
			'sort' => array(
				'attributes' => array(
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
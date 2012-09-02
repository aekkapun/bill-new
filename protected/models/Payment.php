<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property string $id
 * @property string $client_id
 * @property string $contract_id
 * @property string $details
 * @property string $sum
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Contract $contract
 */
class Payment extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Payment the static model class
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
        return 'payment';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('client_id, contract_id, sum', 'required'),
            array('client_id, contract_id', 'length', 'max' => 10),
            array('sum', 'length', 'max' => 20),
            array('details, created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, client_id, contract_id, details, sum, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
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
            'client_id' => 'Клиент',
            'contract_id' => 'Номер договора',
            'details' => 'Назначение платежа',
            'sum' => 'Сумма',
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

		$criteria->with = array( 'client', 'contract' );
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.client_id', $this->client_id);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('sum', $this->sum);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
			'sort' => array(
				'attributes' => array(
					'client.name' => array(
						'asc' => 'client.name ASC',
						'desc' => 'client.name DESC',
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
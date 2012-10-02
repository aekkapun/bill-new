<?php

class Transaction extends CActiveRecord
{
    const TYPE_CREDIT = 1;
    const TYPE_DEBIT = 2;
	

	public static $labels = array(
		self::TYPE_CREDIT => 'Зачисление',
		self::TYPE_DEBIT => 'Списание',
	);
	

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function tableName()
    {
        return 'transaction';
    }


    public function rules()
    {
        return array(
            array('type, contract_id, sum, period', 'required'),
            array('contract_id', 'length', 'max' => 10),
            array('type', 'length', 'max' => 1),
            array('type', 'in', 'range' => array_keys(self::$labels)),
            array('sum', 'length', 'max' => 20),
            array('details, created_at, updated_at, period', 'safe'),
            array('id, type, contract_id, details, sum, created_at, period, updated_at', 'safe', 'on' => 'search'),
        );
    }


    public function relations()
    {
        return array(
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'contract_id' => 'Номер договора',
            'details' => 'Назначение/комментарий',
            'sum' => 'Сумма',
            'type' => 'Тип операции',
            'period' => 'Перод',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
        );
    }


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


    public function search()
    {
        $criteria = new CDbCriteria;

		$criteria->with = array( 'contract' );
        $criteria->compare('t.id', $this->id);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('sum', $this->sum);
        $criteria->compare('type', $this->type);
        $criteria->compare('period', $this->period);
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


    public function getTypeLabel()
    {
        return self::$labels[$this->type];
    }

}
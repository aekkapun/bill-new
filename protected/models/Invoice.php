<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property string $id
 * @property string $number
 * @property string $client_id
 * @property string $contract_id
 * @property string $period
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Contract $contract
 */
class Invoice extends CActiveRecord
{

    /**
     * @return Invoice
     */
    public function my()
    {
        if (Yii::app()->user->checkAccess('manager')) {
            $clients = Client::model()->my()->findAll(array('select' => 'id', 'index' => 'id'));
            if($clients) {
                $criteria = $this->getDbCriteria();
                $criteria->addInCondition('client_id', array_keys($clients));
            }
        }
        return $this;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Invoice the static model class
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
        return 'invoice';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number', 'unique'),
            array('number, client_id, contract_id, period', 'required'),
            array('number', 'length', 'max' => 255),
            array('client_id, contract_id', 'length', 'max' => 10),
            array('period, created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, number, client_id, contract_id, period, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'number' => 'Номер',
            'client_id' => 'Клиент',
            'contract_id' => 'Договор',
            'period' => 'Период',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('client_id', $this->client_id, true);
        $criteria->compare('contract_id', $this->contract_id, true);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
<?php

/**
 * This is the model class for table "client".
 *
 * The followings are the available columns in table 'client':
 * @property string $id
 * @property string $manager_id
 * @property string $name
 * @property string $address
 * @property integer $is_corporate
 * @property string $post_code
 * @property string $code_1c
 * @property string $phone
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property User $manager
 * @property User $user
 * @property ClientAgent[] $clientAgents
 */
class Client extends CActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    /**
     * @return Client
     */
    public function my()
    {
        if (Yii::app()->user->checkAccess('manager') && !Yii::app()->user->checkAccess('admin')) {
            $criteria = $this->getDbCriteria();
            $criteria->addColumnCondition(array(
                'manager_id' => Yii::app()->user->id,
            ));
        }
        return $this;
    }

    public function getStatusLabels()
    {
        return array(
            self::STATUS_ACTIVE => 'Активирован',
            self::STATUS_DISABLED => 'Деактивирован',
        );
    }

    public function getStatusLabel()
    {
        $labels = $this->getStatusLabels();
        return (isset($labels[$this->status]) ? $labels[$this->status] : null);
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Client the static model class
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
        return 'client';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('manager_id, name', 'required'),
            array('is_corporate, status', 'numerical', 'integerOnly' => true),
            array('manager_id', 'length', 'max' => 10),
            array('name, address, post_code, code_1c, phone', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, manager_id, name, address, is_corporate, post_code, code_1c, phone, status, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'manager' => array(self::BELONGS_TO, 'User', 'manager_id'),
            'contracts' => array(self::HAS_MANY, 'Contract', 'client_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Код',
            'manager_id' => 'Менеджер',
            'name' => 'Клиент',
            'address' => 'Адрес',
            'is_corporate' => 'Компания?',
            'post_code' => 'Индекс',
            'code_1c' => 'Код 1С',
            'phone' => 'Телефон',
            'status' => 'Статус',
            'statusLabel' => 'Статус',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('manager_id', $this->manager_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('is_corporate', $this->is_corporate);
        $criteria->compare('post_code', $this->post_code, true);
        $criteria->compare('code_1c', $this->code_1c, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        $dataProvider = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));

        return $dataProvider;
    }
}
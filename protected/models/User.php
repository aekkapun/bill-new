<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $name
 * @property string $role
 * @property string $email
 * @property string $password
 * @property string $hash
 * @property string $created_at
 * @property string $updated_at
 * @property string $client_id
 *
 * The followings are the available model relations:
 * @property Client[] $clients
 * @property Client[] $clients1
 * @property ClientAgent[] $clientAgents
 */
class User extends CActiveRecord
{

    public $newPassword;

    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_ACCOUNTANT = 'accountant';
    const ROLE_CLIENT = 'client';

    public function managers()
    {
        $criteria = $this->getDbCriteria();
        $criteria->addColumnCondition(array(
            'role' => self::ROLE_MANAGER
        ));
        return $this;
    }


    public function getRoleLabels()
    {
        return array(
            self::ROLE_ADMIN => 'Администратор',
            self::ROLE_MANAGER => 'Менеджер',
            self::ROLE_ACCOUNTANT => 'Бухгалтер',
            self::ROLE_CLIENT => 'Представитель клиента',
        );
    }

    public function getRoleLabel()
    {
        $labels = $this->getRoleLabels();
        return (isset($labels[$this->role]) ? $labels[$this->role] : NULL);
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            if ($this->isNewRecord || !empty($this->newPassword)) {
                $this->hash = md5(Yii::app()->securityManager->hashData(microtime(true)));
            }

            if($this->role !== self::ROLE_CLIENT) {
                $this->client_id = NULL;
            }

            return true;
        }

        return false;
    }

    public function beforeSave()
    {
        if (parent::beforeSave()) {

            if ($this->isNewRecord) {
                $this->password = Yii::app()->securityManager->hashPassword($this->password, $this->hash);
            }

            // Если запись не новая и пароль был изменен
            if (!empty($this->newPassword) && !$this->isNewRecord) {
                $this->password = Yii::app()->securityManager->hashPassword($this->newPassword, $this->hash);
            }

            return true;
        }
        return false;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, role, email, password, hash', 'required'),
            array('client_id', 'numerical', 'integerOnly' => true),
            array('name, email', 'length', 'max' => 255),
            array('role', 'length', 'max' => 10),
            array('password, hash, newPassword', 'length', 'max' => 32),
            array('created_at, updated_at', 'safe'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, role, email, password, hash, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'client' => array(self::BELONGS_TO, 'Client', 'id'),
            'clientAgents' => array(self::HAS_MANY, 'ClientAgent', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Код',
            'name' => 'Пользователь',
            'role' => 'Уровень доступа',
            'email' => 'Электропочта',
            'password' => 'Пароль',
            'newPassword' => 'Новый пароль',
            'hash' => 'Ключ',
            'client_id' => 'Клиент',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('role', $this->role, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('hash', $this->hash, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
<?php

/**
 * This is the model class for table "action_log".
 *
 * The followings are the available columns in table 'action_log':
 * @property string $id
 * @property string $user
 * @property string $action
 * @property integer $site_id
 * @property integer $contract_id
 * @property string $created_at
 * @property string $updated_at
 */
class ActionLog extends CActiveRecord
{
    protected function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->user = Yii::app()->user->name;
            return true;
        }
        return false;
    }


    /**
     * Returns the static model of the specified AR class.
     * @return ActionLog the static model class
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
        return 'action_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user, action', 'required'),
            array('site_id, contract_id', 'numerical', 'integerOnly' => true),
            array('user', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user, action, site_id, contract_id, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'user' => 'Пользователь',
            'action' => 'Действие',
            'site_id' => 'Сайт',
            'contract_id' => 'Договор',
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

        $criteria->compare('user', $this->user, true);

        $criteria->compare('action', $this->action, true);

        $criteria->compare('site_id', $this->site_id);

        $criteria->compare('contract_id', $this->contract_id);

        $criteria->compare('created_at', $this->created_at, true);

        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider('ActionLog', array(
            'criteria' => $criteria,
        ));
    }
}
<?php

/**
 * This is the model class for table "adv_platform".
 *
 * The followings are the available columns in table 'adv_platform':
 * @property string $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property float $budget
 * @property int $workPercent
 */
class AdvPlatform extends CActiveRecord
{
    const SYSTEM_GOOGLE = 1;
    const SYSTEM_YANDEX = 2;

    public static $labels = array(
        self::SYSTEM_GOOGLE => 'Google.AdWords',
        self::SYSTEM_YANDEX => 'Яндекс.Директ',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return AdvPlatform the static model class
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
        return 'adv_platform';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, work_percent', 'required'),
            array('budget', 'numerical'),
            array('work_percent', 'numerical', 'min' => 0, 'max' => 100, 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'name' => 'Название',
            'budget' => 'Бюджет',
            'work_percent' => 'Процент работ',
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


    public function beforeSave()
    {
        $this->work_percent = $this->work_percent / 100;

        return parent::beforeSave();
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('work_percent', $this->work_percent);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
<?php

/**
 * This is the model class for table "factor".
 *
 * The followings are the available columns in table 'factor':
 * @property string $id
 * @property string $name
 * @property string $system_id
 * @property string $position
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 */
class Factor extends CActiveRecord
{

    const SYSTEM_GOOGLE = 1;
    const SYSTEM_YANDEX = 2;

    public static $labels = array(
        self::SYSTEM_GOOGLE => 'Google',
        self::SYSTEM_YANDEX => 'Yandex',
    );

    public static function getLabel($systemId)
    {
        $label = (isset(self::$labels[$systemId]) ? self::$labels[$systemId] : null);
        return $label;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Factor the static model class
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
        return 'factor';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, system_id, position, value', 'required'),
            array('name', 'length', 'max' => 255),
            array('system_id, position', 'length', 'max' => 10),
            array('value', 'numerical'),
            array('value', 'length', 'max' => 5),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, system_id, position, value, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'name' => 'Name',
            'system_id' => 'System',
            'position' => 'Position',
            'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
        $criteria->compare('system_id', $this->system_id, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
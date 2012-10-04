<?php

/**
 * This is the model class for table "enumeration_item".
 *
 * The followings are the available columns in table 'enumeration_item':
 * @property string $id
 * @property string $enumeration_id
 * @property string $name
 * @property string $value
 * @property integer $is_default
 * @property integer $active
 * @property string $order
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Enumeration $enumeration
 */
class EnumerationItem extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return EnumerationItem the static model class
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
        return 'enumeration_item';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('enumeration_id, name, value', 'required'),
            array('is_default, active', 'numerical', 'integerOnly' => true),
            array('enumeration_id, order', 'length', 'max' => 10),
            array('name, value', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, enumeration_id, name, value, is_default, active, order, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'enumeration' => array(self::BELONGS_TO, 'Enumeration', 'enumeration_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'enumeration_id' => 'Список',
            'name' => 'Название',
            'value' => 'Значение',
            'is_default' => 'По-умолчнию',
            'active' => 'Активно',
            'order' => 'Порядок',
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
        $criteria->compare('enumeration_id', $this->enumeration_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('is_default', $this->is_default);
        $criteria->compare('active', $this->active);
        $criteria->compare('order', $this->order, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
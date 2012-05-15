<?php

/**
 * This is the model class for table "position_input".
 *
 * The followings are the available columns in table 'position_input':
 * @property string $id
 * @property string $phrase
 * @property string $hash
 * @property string $position
 * @property integer $system_id
 * @property integer $site_id
 * @property string $created_at
 * @property string $updated_at
 * @property float $price
 * @property integer $factor
 *
 */
class PositionInput extends CActiveRecord
{

    public $factors = null;
    public $phraseMeta = null;

    protected function calculateData()
    {
        $factors = array();
        $factorMax = 0;
        foreach ($this->factors as $id => $factor) {
            if ($this->factors[$id]['system_id'] == $this->system_id) {
                $factors[] = $factor;
                if ($factor['position'] > $factorMax) {
                    $factorMax = $factor['position'];
                }
            }
        }

        if ($this->position > $factorMax) {
            $factorValue = 0;
        } else {
            foreach ($factors as $index => $factor) {
                $current = $factor['position'];
                $next = isset($factors[$index + 1]) ? $factors[$index + 1]['position'] : null;

                if ($this->position <= $current) {
                    $factorValue = $factor['value'];
                    break;
                }

                if ($this->position > $current && $this->position < $next) {
                    $factorValue = $factors[$index + 1]['value'];
                    break;
                }

                if ($next == null) {
                    break;
                }
            }
        }

        $this->factor = $factorValue;
        $this->price = $this->phraseMeta['price'] * $this->factor;
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->calculateData();

            return true;
        }

        return false;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return PositionInput the static model class
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
        return 'position_input';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('phrase, hash, position, system_id, created_at, site_id, price, factor, factors, phraseMeta', 'required'),
            array('system_id, site_id, position', 'numerical', 'integerOnly' => true),
            array('hash', 'length', 'max' => 255),
            array('position', 'length', 'max' => 10),
            array('created_at, updated_at, params', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, phrase, hash, position, system_id, created_at, updated_at, site_id', 'safe', 'on' => 'search'),
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
            'phrase' => 'Запрос',
            'hash' => 'Хеш',
            'position' => 'Позиция',
            'system_id' => 'Система',
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
        $criteria->compare('phrase', $this->phrase, true);
        $criteria->compare('hash', $this->hash, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('system_id', $this->system_id);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property string $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Service extends CActiveRecord
{

    /**
     * Абонентская плата
     */
    const SUBSCRIPTION = 1;

    /**
     * По позициям
     */
    const POSITION = 2;

    /**
     * По переходам
     */
    const TRANSITION = 3;

    /**
     * Контекстная реклама
     */
    const CONTEXT = 4;

    /**
     * Баннерная реклама
     */
    const BANNERS = 5;

    /**
     * Разовая услуга
     */
    const ONETIME = 6;

    public static function getLabel($serviceTypeId, $modelId = null)
    {
        // Если тип услуги "разовая услуга", то возвращаем название услуги
        if ($serviceTypeId == self::ONETIME && $modelId !== null) {
            $params = SiteService::model()->findByPk($modelId)->params;
            $JSONParams = CJSON::decode($params);
            return $JSONParams['name'];
        }

        // Иначе - возвращаем тип услуги
        $model = self::model()->findByPk($serviceTypeId);
        return $model->name;
    }

    public static function getControllerName($id)
    {
        switch ($id) {
            case self::POSITION:
                return 'position';
                break;
            case self::TRANSITION:
                return 'transition';
                break;
            case self::CONTEXT:
                return 'context';
                break;
            case self::SUBSCRIPTION:
                return 'subscription';
                break;
            case self::BANNERS:
                return 'banner';
                break;
            case self::ONETIME:
                return 'onetime';
                break;
            default:
                return null;
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Service the static model class
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
        return 'service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
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
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
<?php

/**
 * This is the model class for table "site_service".
 *
 * The followings are the available columns in table 'site_service':
 * @property string $id
 * @property string $site_id
 * @property string $service_id
 * @property string $params
 * @property string $options
 * @property string $created_at
 * @property string $updated_at
 * @property int $contract_id
 *
 */
class SiteService extends CActiveRecord
{


    public function beforeSave()
    {
        if (parent::beforeSave()) {


            return true;
        }

        return false;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return SiteService the static model class
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
        return 'site_service';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site_id, service_id, created_at, contract_id', 'required'),
            array('site_id, service_id', 'length', 'max' => 10),
            array('params, options, created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, site_id, service_id, params, options, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'site_id' => 'Сайт',
            'service_id' => 'Услуга',
            'params' => 'Параметры',
            'options' => 'Опции',
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
        $criteria->compare('site_id', $this->site_id, true);
        $criteria->compare('service_id', $this->service_id, true);
        $criteria->compare('params', $this->params, true);
        $criteria->compare('options', $this->options, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
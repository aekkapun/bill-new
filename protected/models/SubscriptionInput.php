<?php

/**
 * This is the model class for table "subscription_input".
 *
 * The followings are the available columns in table 'subscription_input':
 * @property string $id
 * @property string $site_id
 * @property string $link_count
 * @property string $created_at
 * @property string $updated_at
 * @property integer $contract_id
 * @property integer $transitions_count
 *
 */
class SubscriptionInput extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return SubscriptionInput the static model class
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
        return 'subscription_input';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site_id, link_count, transitions_count', 'required'),
            array('site_id, link_count, transitions_count', 'length', 'max' => 10),
            array('created_at, updated_at', 'safe'),
            array('contract_id', 'numerical'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, site_id, link_count, created_at, updated_at, transitions_count', 'safe', 'on' => 'search'),
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
            'link_count' => 'Количество ссылок',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'transitions_count' => 'Количество переходов',
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
        $criteria->compare('link_count', $this->link_count, true);
        $criteria->compare('transitions_count', $this->transitions_count, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    public static function getDataByDate( $ssId, $date )
    {
        $siteService = SiteService::model()->findByPk( $ssId );

        $model = self::model()->findByAttributes(array(
            'site_id' => $siteService->site_id,
            'created_at' => date('Y-m-d H:i:s', strtotime($date)),
        ));


        if( !empty($model) )
        {
            $status = 'success';
            $data = array(
                'link_count' => $model->link_count,
                'transitions_count' => $model->transitions_count,
            );
        }
        else
        {
            $status = 'empty';
            $data = array(
                'link_count' => '',
                'transitions_count' => '',
            );
        }


        return array(
            'status' => $status,
            'data' => $data,
        );
    }


}
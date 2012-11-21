<?php

/**
 * This is the model class for table "report_subscription".
 *
 * The followings are the available columns in table 'report_subscription':
 * @property string $id
 * @property integer $report_id
 * @property integer $site_id
 * @property string $sum
 * @property integer $link_count
 * @property string $avg_link_price
 * @property integer $transitions_count
 * @property decimal $avg_transition_price
 * @property string $created_at
 * @property string $updated_at
 */
class ReportSubscription extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return ReportSubscription the static model class
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
        return 'report_subscription';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('report_id, site_id, link_count', 'numerical', 'integerOnly' => true),
            array('sum, avg_link_price, transitions_count, avg_transition_price', 'length', 'max' => 20),
            array('created_at, updated_at', 'safe'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, report_id, site_id, sum, link_count, avg_link_price, created_at, updated_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'report_id' => 'Report',
            'site_id' => 'Site',
            'sum' => 'Sum',
            'link_count' => 'Link Count',
            'avg_link_price' => 'Avg Link Price',
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
        $criteria->compare('report_id', $this->report_id);
        $criteria->compare('site_id', $this->site_id);
        $criteria->compare('sum', $this->sum, true);
        $criteria->compare('link_count', $this->link_count);
        $criteria->compare('avg_link_price', $this->avg_link_price, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    /**
     * Returns total balance
     *
     *  return 321554;
     */
    public static function getBalance($reportId)
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'sum(sum) as sum';
        $criteria->condition = 'report_id = :report_id';
        $criteria->params = array(':report_id' => $reportId);

        $balance = self::model()->find($criteria)->sum;

        return $balance;
    }

}
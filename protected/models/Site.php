<?php

/**
 * This is the model class for table "site".
 *
 * The followings are the available columns in table 'site':
 * @property string $id
 * @property string $client_id
 * @property string $domain
 * @property string $created_at
 * @property string $updated_at
 * @property string $region
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property SiteContract[] $siteContracts
 */
class Site extends CActiveRecord
{

    public $contractId;

    public function beforeSave()
    {
        if (parent::beforeSave()) {

            /*if (!empty($this->contracts)) {
                $siteContracts = array();
                foreach ($this->contracts as $index => $contract_id) {
                    $siteContract = new SiteContract();
                    $siteContract->attributes = array(
                        'contract_id' => $contract_id
                    );
                    $siteContracts[] = $siteContract;
                }
                $this->siteContracts = $siteContracts;
            }*/

            return true;
        }

        return false;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Site the static model class
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
        return 'site';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('client_id, domain', 'required'),
            array('client_id', 'length', 'max' => 10),
            array('domain', 'length', 'max' => 255),
            array('domain', 'url'),
            array('contracts, created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, client_id, domain, created_at, updated_at', 'safe', 'on' => 'search'),
            array('region', 'length', 'max' => 255),
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
            'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
            'siteContracts' => array(self::HAS_MANY, 'SiteContract', 'site_id'),
            'sitePhrases' => array(self::HAS_MANY, 'SitePhrase', 'site_id'),
            'siteFactors' => array(self::HAS_MANY, 'Factor', 'site_id'),
            'siteServices' => array(self::HAS_MANY, 'SiteService', 'site_id'),
            'siteRanges' => array(self::HAS_MANY, 'SiteRange', 'site_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'client_id' => 'Клиент',
            'domain' => 'Домен',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'region' => 'Регион продвижения',
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

		$criteria->with = array( 'client' );
        $criteria->compare('t.id', $this->id);
        $criteria->compare('client_id', $this->client_id);
        $criteria->compare('domain', $this->domain, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);
        $criteria->compare('region', $this->region, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
			'sort' => array(
				'attributes' => array(
					'client.name' => array(
						'asc' => 'client.name ASC',
						'desc' => 'client.name DESC',
					),
					'*',
				),
			),
        ));
    }
}
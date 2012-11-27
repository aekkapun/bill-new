<?php

/**
 * This is the model class for table "site_phrase_group".
 *
 * The followings are the available columns in table 'site_phrase_group':
 * @property string $id
 * @property string $name
 * @property string $site_id
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property ReportTransition[] $reportTransitions
 * @property SitePhrase[] $sitePhrases
 * @property Site $site
 * @property SiteRangeName[] $siteRangeNames
 */
class SitePhraseGroup extends CActiveRecord
{
    const DEFAULT_NAME = 'по-умолчанию';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SitePhraseGroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_phrase_group';
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
			array('name', 'length', 'max'=>255),
			array('site_id', 'length', 'max'=>10),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, site_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'reportTransitions' => array(self::HAS_MANY, 'ReportTransition', 'site_phrase_group_id'),
			'sitePhrases' => array(self::HAS_MANY, 'SitePhrase', 'site_phrase_group_id'),
			'site' => array(self::BELONGS_TO, 'Site', 'site_id'),
			'siteRangeNames' => array(self::HAS_MANY, 'SiteRangeName', 'site_phrase_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'name' => 'Название',
			'site_id' => 'Сайт',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('site_id',$this->site_id,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
        $criteria->with = array('site');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'attributes' => array(
                    'site.domain' => array(
                        'asc' => 'site.domain ASC',
                        'desc' => 'site.domain DESC',
                    ),
                    '*',
                ),
            ),
		));
	}


    public static function getGroupsBySiteId( $siteId )
    {
        $groups = array(
            '' => self::DEFAULT_NAME
        );

            if( !empty($siteId) )
        {
            $models = self::model()->findAllByAttributes(array(
                'site_id' => $siteId
            ));

            $groups += CHtml::listData( $models, 'id', 'name' );
        }

        return $groups;
    }


}
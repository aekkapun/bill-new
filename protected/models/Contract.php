<?php

/**
 * This is the model class for table "contract".
 *
 * The followings are the available columns in table 'contract':
 * @property string $id
 * @property string $number
 * @property string $client_id
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Client $client
 */
class Contract extends CActiveRecord
{

    public $fileType = 'doc,docx,pdf,rtf';

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;
	
	public $attachments_count;

    /**
     * How many attachments will be view in table
     */
    public $attachmentsPageSize = 20;

    /**
     * @return Contract
     */
    public function my()
    {
        if (Yii::app()->user->checkAccess('manager')) {
            $clients = Client::model()->my()->findAll(array('select' => 'id', 'index' => 'id'));
            if ($clients) {
                $criteria = $this->getDbCriteria();
                $criteria->addInCondition('client_id', array_keys($clients));
            }
        }
        return $this;
    }

    public function getStatusLabels()
    {
        return array(
            self::STATUS_ACTIVE => 'Действующий',
            self::STATUS_DISABLED => 'Расторгнут',
        );
    }

    public function getStatusLabel()
    {
        $labels = $this->getStatusLabels();
        return (isset($labels[$this->status]) ? $labels[$this->status] : null);
    }

    public function by($name, $value)
    {
        $criteria = $this->getDbCriteria();
        $criteria->addColumnCondition(array(
            $name => $value
        ));
        return $this;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Contract the static model class
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
        return 'contract';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, client_id', 'required'),
            array('number', 'unique'),
            array('status', 'numerical', 'integerOnly' => true),
            array('number', 'length', 'max' => 255),
            array('client_id', 'length', 'max' => 10),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, number, client_id, status, created_at, updated_at, attachments_count', 'safe', 'on' => 'search'),
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
            'attachments' => array(self::HAS_MANY, 'ContractAttachment', 'contract_id'),
			'attachmentsCount' => array(self::STAT, 'ContractAttachment', 'contract_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
			'attachments_count' => 'Вложения',
            'number' => 'Номер договора',
            'client_id' => 'Клиент',
            'status' => 'Статус',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'has_file' => 'Файлы?',
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
            ),
            'ResourcesBehavior' => array(
                'class' => 'ext.resourcesBehavior.ResourcesBehavior',
                'resourcePath' => Yii::app()->params['uploadDir'],
            ),
        );
    }

    public function afterSave()
    {
        $files = CUploadedFile::getInstances($this, 'attachments');

        $hash = $this->generatePathHash();

        if (!empty($files)) {
            foreach ($files as $file) {
                $attachment = new ContractAttachment();
                $meta = Common::processFile($attachment, $file, $hash);
                $attributes = array(
                    'contract_id' => $this->id,
                    'file' => $meta,
                    'name' => $file->name,
                );
                $attachment->attributes = $attributes;
                $attachment->save();
            }
        }

        parent::afterSave();
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

		$attachments_table = ContractAttachment::model()->tableName();
		$attachments_count_sql = "IF ((SELECT COUNT(*) FROM $attachments_table WHERE $attachments_table.contract_id = t.id) > 0, 1, 0)";
		
		$criteria->select = array(
			'*',
			$attachments_count_sql . ' as attachments_count',
		);
		
		$criteria->with = array( 'client' );
		$criteria->compare('t.id', $this->id);
        $criteria->compare('number', $this->number);
        $criteria->compare('client_id', $this->client_id);
		$criteria->compare('t.status', $this->status);
		$criteria->compare( $attachments_count_sql, $this->attachments_count );
		
		/*
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);
		*/
		
        $dataProvider = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
			
			'sort' => array(
				'attributes' => array(
					'client.name' => array(
						'asc' => 'client.name ASC',
						'desc' => 'client.name DESC',
					),
					'attachments_count' => array(
						'asc' => 'attachments_count ASC',
						'desc' => 'attachments_count DESC',
					),
					'*',
				),
			),		
		));

        return $dataProvider;
    }
	
	/**
	 * Return TRUE if contract has attachments
	 */
	public function getHasAttachments()
	{		
		return ($this->attachmentsCount > 0);
	}


    /**
     * Returns attachments as DataProvider object
     */
    public function attachmentsAsDataProvider()
    {
        return new CArrayDataProvider($this->attachments, array(
            'sort' => array(
                'attributes' => array(
                    'name',
                ),
            ),
            'pagination' => array(
                'pageSize' => $this->attachmentsPageSize,
            ),
        ));
    }


    /**
     * Returns array
     *
     *  array(
     *      [1] => '10/12 от 11.10.2012',
     *      [2] => '11/12 от 06.11.2012',
     *      [3] => '12/12 от 25.12.2012',
     *  )
     */
    public static function getTogetherIdAndDate( $attributes = array() )
    {
        $contracts = self::model()->my()->findAllByAttributes( $attributes );

        $array = array();

        foreach( $contracts as $contract )
        {
            $date = Yii::app()->dateFormatter->format('dd.MM.yyyy', strtotime($contract->created_at));
            $array[$contract->id] = "{$contract->number} от $date";
        }

        return $array;
    }


}
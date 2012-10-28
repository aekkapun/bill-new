<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property string $id
 * @property string $number
 * @property string $client_id
 * @property string $contract_id
 * @property string $period
 * @property string $created_at
 * @property string $updated_at
 * @property string $file
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Contract $contract
 */
class Invoice extends CActiveRecord
{
    public $allowedFileType = 'jpg,jpeg,png,doc,docx,xls,xlsx,pdf';

    public $newFile;


    /**
     * @return Invoice
     */
    public function my()
    {
        if (Yii::app()->user->checkAccess('manager')) {
            $clients = Client::model()->my()->findAll(array('select' => 'id', 'index' => 'id'));
            if($clients) {
                $criteria = $this->getDbCriteria();
                $criteria->addInCondition('t.client_id', array_keys($clients));
            }
        }
        return $this;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Invoice the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName( $lang='en' )
    {
        $names = array(
            'en' => 'invoice',
            'ru' => 'Счет-фактура',
        );

        return isset( $names[$lang] ) ? $names[$lang] : '';
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number', 'unique'),
            array('number, client_id, contract_id, period', 'required'),
            array('number, file', 'length', 'max' => 255),
            array('client_id, contract_id', 'length', 'max' => 10),
            array('period, created_at, updated_at', 'safe'),

            array('file', 'file', 'types' => $this->allowedFileType, 'allowEmpty' => false, 'on' => 'insert'),
            array('newFile', 'file', 'types' => $this->allowedFileType, 'allowEmpty' => true),

            array('id, number, client_id, contract_id, file, period, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'number' => 'Номер',
            'client_id' => 'Клиент',
            'contract_id' => 'Номер договор',
            'period' => 'Период',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'file' => 'Файл',
            'newFile' => 'Новый файл',
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
            ),
            'ResourcesBehavior' => array(
                'class' => 'ext.resourcesBehavior.ResourcesBehavior',
                'resourcePath' => Yii::app()->params['uploadDir'],
            ),
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
		
		$criteria->with = array( 'client', 'contract' );
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.number', $this->number, true);
        $criteria->compare('t.client_id', $this->client_id);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('period', $this->period, true);
        $criteria->compare('file', $this->file);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
			'sort' => array(
				'attributes' => array(
					'client.name' => array(
						'asc' => 'client.name ASC',
						'desc' => 'client.name DESC',
					),
					'contract.number' => array(
						'asc' => 'contract.number ASC',
						'desc' => 'contract.number DESC',
					),
					'*',
				),
			),
        ));
    }


    public function afterSave()
    {
        $attribute = $this->isNewRecord ? 'file' : 'newFile';
        $file = CUploadedFile::getInstance($this, $attribute);

        $hashString = $this->generatePathHash();

        if ($file !== null) {
            $fileName = Common::processFile($this, $file, $hashString);
            $this->updateByPk($this->id, array(
                'file' => $fileName,
            ));
            $this->setAttribute('file', $fileName);
        }

        parent::afterSave();
    }


    public function getFile($onlyFileName = false)
    {
        return $this->getResourcePath($this->file, 0, array('onlyFileName' => $onlyFileName));
    }
}
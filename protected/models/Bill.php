<?php

/**
 * This is the model class for table "bill".
 *
 * The followings are the available columns in table 'bill':
 * @property string $id
 * @property string $client_id
 * @property string $contract_id
 * @property string $number
 * @property string $sum
 * @property string $file
 * @property string $period
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Client $client
 * @property Contract $contract
 */
class Bill extends CActiveRecord
{

    public $fileType = 'doc,docx,pdf,rtf';

    public $newFile;

    /**
     * @return Bill
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

    public function getFile($onlyFileName = false)
    {
        return $this->getResourcePath($this->file, 0, array('onlyFileName' => $onlyFileName));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Bill the static model class
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
            'en' => 'bill',
            'ru' => 'Счет',
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
            array('client_id, contract_id, number, period, sum', 'required'),
            array('client_id, contract_id', 'length', 'max' => 10),
            array('number, file', 'length', 'max' => 255),
            array('sum', 'length', 'max' => 20),
            array('period, created_at, updated_at', 'safe'),

            array('file', 'file', 'types' => $this->fileType, 'allowEmpty' => false, 'on' => 'insert'),
            array('newFile', 'file', 'types' => $this->fileType, 'allowEmpty' => true),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, client_id, contract_id, number, sum, file, period, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'client_id' => 'Клиент',
            'contract_id' => 'Номер договора',
            'number' => 'Номер',
            'sum' => 'Сумма',
            'file' => 'Файл',
            'newFile' => 'Новый файл',
            'period' => 'Период',
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
            ),
            'ResourcesBehavior' => array(
                'class' => 'ext.resourcesBehavior.ResourcesBehavior',
                'resourcePath' => Yii::app()->params['uploadDir'],
            ),
        );
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
        $criteria->compare('t.client_id', $this->client_id);
        $criteria->compare('contract_id', $this->contract_id);
        $criteria->compare('t.number', $this->number, true);
        $criteria->compare('sum', $this->sum);
        $criteria->compare('file', $this->file);
        $criteria->compare('period', $this->period, true);
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


}
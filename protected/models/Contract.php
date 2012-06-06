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
            array('id, number, client_id, status, created_at, updated_at', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'number' => 'Договор',
            'client_id' => 'Клиент',
            'status' => 'Статус',
            'statusLabel' => 'Статус',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('client_id', $this->client_id, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        $dataProvider = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));

        return $dataProvider;
    }
}
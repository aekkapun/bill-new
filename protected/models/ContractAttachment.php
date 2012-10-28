<?php

/**
 * This is the model class for table "contract_attachment".
 *
 * The followings are the available columns in table 'contract_attachment':
 * @property string $id
 * @property string $contract_id
 * @property string $file
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Contract $contract
 */
class ContractAttachment extends CActiveRecord
{

    public $fileType = 'doc,docx,pdf,rtf';

    public function getFile($onlyFileName = false)
    {
        return $this->getResourcePath($this->file, 0, array('onlyFileName' => $onlyFileName));
    }

    /**
     * Returns the static model of the specified AR class.
     * @return ContractAttachment the static model class
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
            'en' => 'contract_attachment',
            'ru' => 'Приложение к договору',
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
            array('contract_id', 'required'),
            array('contract_id', 'length', 'max' => 10),
            array('name, file', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, contract_id, file, created_at, updated_at', 'safe', 'on' => 'search'),
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
            'contract_id' => 'Contract',
            'file' => 'File',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('contract_id', $this->contract_id, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}
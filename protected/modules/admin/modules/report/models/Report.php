<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property string $id
 * @property string $period_begin
 * @property string $period_end
 * @property string $client_id
 * @property integer $status
 * @property integer $contract_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Client $client
 */
class Report extends CActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PENDING = 1;
    const STATUS_FINISHED = 2;

    const CONTRACT_STATUS_ACTIVE = 1;
    const CONTRACT_STATUS_EXPIRED = 0;

    public $statusLabel = array(
        self::STATUS_NEW => 'Новый',
        self::STATUS_PENDING => 'В очереди',
        self::STATUS_FINISHED => 'Выполнен',
    );

    public $contractStatusLabel = array(
        self::CONTRACT_STATUS_ACTIVE => 'Только активные',
        self::CONTRACT_STATUS_EXPIRED => 'Не активные',
    );

    public $statusLabelBadge = array(
        self::STATUS_NEW => '',
        self::STATUS_PENDING => 'label-info',
        self::STATUS_FINISHED => 'label-success',
    );

    public $subReports = array(
        'ReportPosition',
        'ReportSubscription',
        'ReportContext',
        'ReportBanner',
        'ReportCustom',
    );


    public function getStatusLabel($status = false)
    {
        $key = ($status && is_numeric($status)) ? $status : $this->status;
        return isset($this->statusLabel[$key]) ? $this->statusLabel[$key] : 'undefined';
    }

    public function getStatusLabelBadge($status = false)
    {
        $key = ($status && is_numeric($status)) ? $status : $this->status;
        return isset($this->statusLabelBadge[$key]) ? $this->statusLabelBadge[$key] : '';
    }

    public function getContractStatusLabel($contractStatus = false)
    {
        $key = ($contractStatus && is_numeric($$contractStatus)) ? $contractStatus : $this->contract_status;
        return isset($this->contractStatusLabel[$key]) ? $this->contractStatusLabel[$key] : 'undefined';
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Report the static model class
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
        return 'report';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('period_begin, period_end, client_id, name', 'required'),
            array('status, contract_status', 'numerical', 'integerOnly' => true),
            array('client_id', 'length', 'max' => 10),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, period_begin, period_end, client_id, status, contract_status, created_at, updated_at', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'period_begin' => 'Начало периода',
            'period_end' => 'Окончание периода',
            'client_id' => 'Клиент',
            'status' => 'Статус',
            'contract_status' => 'Договоры',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
            'name' => 'Название',
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
        $criteria->compare('period_begin', $this->period_begin, true);
        $criteria->compare('period_end', $this->period_end, true);
        $criteria->compare('client_id', $this->client_id, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('contract_status', $this->contract_status);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    /**
     * Returns balance array
     *
     *  return array(
     *      'totalBalancePerPeriod' => 300000,
     *      'balanceByContract' => -100000,
     *      'totalBalance' => 400000,
     *  )
     *
     */
    public function getBalanceInfo()
    {
        $totalBalancePerPeriod = 0;

        foreach( $this->subReports as $subReport )
        {
            $totalBalancePerPeriod += $subReport::getBalance( $this->id );
        }

        $balanceByContract = -100000;

        $totalBalance = $totalBalancePerPeriod - $balanceByContract;

        $balanceArray = array(
           'totalBalancePerPeriod' => $totalBalancePerPeriod,
           'balanceByContract' => $balanceByContract,
           'totalBalance' => $totalBalance,
        );

        return $balanceArray;
    }
}
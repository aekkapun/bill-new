<?php
/**
 *
 */
class BankclientAdapter extends CFormModel implements AdapterInterface
{

    public $projectId;

    public $dataFile;

    public function getName()
    {
        return 'bankclient';
    }

    public function getSessionDataKey()
    {
        $adapterClassName = ucfirst($this->name) . 'Adapter';
        return $adapterClassName . '_data';
    }

    public function rules()
    {
        return array(
            array('projectId', 'required'),
            array('dataFile', 'file', 'allowEmpty' => false, 'types' => array('txt')),
        );
    }

    public function attributeLabels()
    {
        return array(
            'projectId' => 'Проект',
            'dataFile' => 'Файл банк-клиента',
        );
    }

    public function getForm()
    {
        return array(
            'title' => 'Импорт данных из банк-клиента',

            'elements' => array(
                'projectId' => array(
                    'type' => 'dropdownlist',
                    'items' => CHtml::listData(Project::model()->active()->findAll(), 'id', 'name'),
                    'prompt' => 'Выберите проект:',
                ),
                'dataFile' => array(
                    'type' => 'file',
                    'visible' => true,
                ),
            ),

            'buttons' => array(
                'preview' => array(
                    'type' => 'submit',
                    'label' => 'Импорт и предпросмотр результатов',
                ),
            ),
            'attributes' => array(
                'enctype' => 'multipart/form-data'
            ),
        );
    }

    public function process()
    {
        $file = CUploadedFile::getInstance($this, 'dataFile');
        $content = file_get_contents($file->getTempName());
        $content = iconv('windows-1251', 'utf-8', $content);

        $project = Project::model()->findByPk($this->projectId);

        $rawData = Parser1C::factory('v8')->parseIncomeTransactionsForAccount($content, $project->account_number);

        $result = array(
            'status' => AdapterInterface::PROCESS_STATUS_FAIL,
            'data' => null,
            'errorMessage' => null,
        );

        if ($rawData !== null) {
            $result = array(
                'status' => AdapterInterface::PROCESS_STATUS_OK,
                'data' => $rawData,
            );
        } else {
            $result['errorMessage'] = 'Не удалось распознать файл банк-клиента';
        }

        return $result;
    }

    public function commit($result)
    {
        $result = Yii::app()->session->get($this->sessionDataKey);

        if (!$result) {
            return null;
        }

        $stat = array(
            'saved' => array(),
            'error' => array(),
            'worked' => array(),
        );

        $rawData = $result['data'];

        if ($rawData === null && !is_array($rawData)) {
            Yii::app()->user->setFlash('notice', 'Нет данных для обработки.');
            return null;
        }

        $countAll = count($rawData);

        $db = Yii::app()->db;
        $transaction = $db->beginTransaction();

        try {

            foreach ($rawData as $data) {

                //Так как поля в 1с на кирилице, делаем их хеши
                $refLabel = md5('Номер');
                $innLabel = md5('ПлательщикИНН');
                $kppLabel = md5('ПлательщикКПП');
                $sumLabel = md5('Сумма');
                $dateLabel = md5('ДатаПоступило');
                $accountFromLabel = md5('ПлательщикРасчСчет');
                $accountToLabel = md5('ПолучательРасчСчет');

                // Пробуем определить контрагента по ИНН
                $partner = Partner::model()->findByAttributes(array(
                    'inn' => $data[$innLabel],
                ));

                $trans = new Transaction();

                $attributes = array(
                    'number' => $data[$refLabel],
                    'partner_inn' => $data[$innLabel],
                    'partner_kpp' => $data[$kppLabel],
                    'account_to' => $data[$accountToLabel],
                    'account_from' => $data[$accountFromLabel],
                    'sum' => $data[$sumLabel],
                    'created_at' => new CDbExpression('FROM_UNIXTIME(' . strtotime($data[$dateLabel]) . ')'),
                    'status' => Transaction::QUEUED, // считаем что Контрагент не найден и не будет найден
                );

                $checksum = CMap::mergeArray($attributes, array('number' => $data[$refLabel]));

                unset($checksum['status']);

                ksort($checksum);

                $checksumString = join('_', $checksum);
                $attributes['checksum'] = md5($checksumString);

                // Проверяем уникальность транзакции
                $model = Transaction::model()->findByAttributes(array(
                    'checksum' => $attributes['checksum'],
                ));


                $trans->attributes = $attributes;

                // Если нашелся контрагент с таким ИНН
                // то синхронизируем статус Контрагента и статус Транзакции
                if ($partner !== null) {

                    $mediator = new StatusMediator($partner, $trans);
                    $attributes['status'] = $mediator->transaction->status;

                }

                if ($model === null) {
                    //Если транзакция уникальна, то записываем ее в БД
                    if (!$trans->save()) {
                        $stat['error'][] = $trans;
                    } else {
                        $stat['saved'][] = $trans;
                    }
                } else {
                    $stat['worked'][] = $trans;
                }
            }

            $savedDataProvider = new CArrayDataProvider($stat['saved']);
            $workedDataProvider = new CArrayDataProvider($stat['worked']);
            $errorDataProvider = new CArrayDataProvider($stat['error']);

            if (count($stat['error']) > 0) {
                Yii::app()->user->setFlash('error', 'ВНИМАНИЕ! Произошла ошибка сервера. Попробуйте еще раз или обратитесь к администратору биллинга');
                $transaction->rollback();
            } else {
                $transaction->commit();
            }

            Yii::app()->session->remove($this->sessionDataKey);

            return array(
                'countAll' => $countAll,
                'countSaved' => count($stat['saved']),
                'countWorked' => count($stat['worked']),
                'countError' => count($stat['error']),
                'savedDataProvider' => $savedDataProvider,
                'workedDataProvider' => $workedDataProvider,
                'errorDataProvider' => $errorDataProvider,
            );

        } catch (CException $e) {
            $transaction->rollback();
            Yii::app()->user->setFlash('notice', 'Произошла ошибка при сохранении транзакций' . $e->getMessage());
        }
    }
}

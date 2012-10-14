<?php
/**
 *
 */
class PhraseImportAdapter extends CFormModel implements AdapterInterface
{

    public $siteId;

    public $dataFile;

    public function getName()
    {
        return 'phraseImport';
    }

    public function getSessionDataKey()
    {
        $adapterClassName = ucfirst($this->name) . 'Adapter';
        return $adapterClassName . '_data';
    }

    public function rules()
    {
        return array(
            array('siteId', 'required'),
            array('dataFile', 'file', 'allowEmpty' => false, 'types' => array('csv')),
        );
    }

    public function attributeLabels()
    {
        return array(
            'siteId' => 'Сайт',
            'dataFile' => 'Список запросов',
        );
    }

    public function getForm()
    {
        return array(
            'title' => 'Импорт',

            'elements' => array(
                'siteId' => array(
                    'type' => 'dropdownlist',
                    'items' => CHtml::listData(Site::model()->findAll(), 'id', 'domain'),
                    'prompt' => 'Выберите сайт:',
                ),
                'dataFile' => array(
                    'type' => 'file',
                    'visible' => true,
                ),
                '<div class="row">Файл должен быть в кодировке UTF-8</div>',
            ),

            'buttons' => array(
                'preview' => array(
                    'type' => 'submit',
                    'label' => 'Импорт и предпросмотр результатов',
                ),
            ),
            'attributes' => array(
                'enctype' => 'multipart/form-data',
            ),
        );
    }

    public function process()
    {
        $file = CUploadedFile::getInstance($this, 'dataFile');
        $content = file_get_contents($file->getTempName());

        $site = Site::model()->findByPk($this->siteId);

        $rawData = str_getcsv($content, "\r\n");
        $rawData = array_slice($rawData, 1, count($rawData));

        $data = array();
        foreach ($rawData as $row) {
            $row = explode(';', $row);
            $item = array(
                'phrase' => $row[0],
                'price' => $row[1],
                'site_id' => $site->id,
                'active' => 1,
            );
            $data[] = $item;
        }

        $result = array(
            'status' => AdapterInterface::PROCESS_STATUS_FAIL,
            'data' => null,
            'errorMessage' => null,
        );

        if ($rawData !== null) {
            $result = array(
                'status' => AdapterInterface::PROCESS_STATUS_OK,
                'data' => $data,
            );
        } else {
            $result['errorMessage'] = 'Не удалось распознать файл';
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

                $sitePhrase = new SitePhrase();
                $sitePhrase->attributes = $data;

                if ($sitePhrase->save()) {
                    $stat['saved'][] = $sitePhrase;
                } else {
                    $stat['error'][] = $sitePhrase;
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
                'countError' => count($stat['error']),
                'savedDataProvider' => $savedDataProvider,
                'errorDataProvider' => $errorDataProvider,
            );

        } catch (CException $e) {
            $transaction->rollback();
            Yii::app()->user->setFlash('notice', 'Произошла ошибка при сохранении транзакций' . $e->getMessage());
        }
    }
}

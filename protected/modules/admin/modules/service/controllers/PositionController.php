<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/2/12
 * Time: 4:01 PM
 * To change this template use File | Settings | File Templates.
 */
class PositionController extends Controller
{
    public function actions()
    {
        return array(
            'getFilledDays' => array('class' => 'application.modules.admin.modules.service.components.LiveService.GetFilledDaysAction'),
            'getDataByDate' => array('class' => 'application.modules.admin.modules.service.components.LiveService.GetDataByDateAction'),
        );
    }


    public function actionSubscribe($siteId)
    {
        $site = $this->loadSite($siteId);
        $service = Service::model()->findByPk(Service::POSITION);
        $siteService = new SiteService();
        $factors = Factor::model()->findAll(array('index' => 'id'));
        $phrases = SitePhrase::model()->findAllByAttributes(array(
            'site_id' => $site->id,
        ), array('index' => 'id'));

        if (isset($_POST['SiteService']) && isset($_POST['Factor']) && isset($_POST['SitePhrase'])) {

            $siteService->attributes = $_POST['SiteService'];

            $valid = true;
            foreach ($_POST['Factor'] as $index => $attributes) {
                if (isset($factors[$index])) {
                    $factors[$index]->attributes = $attributes;
                    $valid = $factors[$index]->validate() && $valid;
                }
            }

            $valid = $valid && true;
            foreach ($_POST['SitePhrase'] as $index => $attributes) {
                if (isset($phrases[$index])) {
                    $phrases[$index]->attributes = $attributes;
                    $valid = $phrases[$index]->validate() && $valid;
                }
            }

            if ($valid) {

                $params['phrases'] = array_values($phrases);
                $params['factors'] = array_values($factors);

                $siteService->params = CJSON::encode($params);

                if ($siteService->save()) {
                    $this->redirect(array('/admin/site/default/view', 'id' => $site->id));
                }
            }
        }

        $this->render('subscribe', array(
            'site' => $site,
            'service' => $service,
            'siteService' => $siteService,
            'factors' => $factors,
            'phrases' => $phrases,
        ));
    }

    public function actionInput($ssId)
    {
        $siteService = SiteService::model()->findByPk($ssId);
        $site = $this->loadSite($siteService->site_id);

        $params = CJSON::decode($siteService->params);

        $positionForm = new PositionForm();

        $phrases = array();

        // Для каждой системы (яндекс, гугл) составляем список запросов
        foreach (Factor::$labels as $system_id => $label) {
            $phrases[$system_id] = array(
                'name' => $label,
                'phrases' => array(),
            );
            foreach ($params['phrases'] as $i => $phrase) {
                $phrases[$system_id]['phrases'][$i] = new PositionInput();
                $phrases[$system_id]['phrases'][$i]->attributes = array(
                    'hash' => $phrase['hash'],
                    'phrase' => $phrase['phrase'],
                );
                $phrases[$system_id]['phrases'][$i]->factors = $params['factors'];
                $phrases[$system_id]['phrases'][$i]->phraseMeta = $phrase;
            }
        }


        // Сохранение
        if (isset($_POST['PositionInput']) && $_POST['PositionForm'])
        {
            $date = $_POST['PositionForm']['created_at'];
            $models = PositionInput::getBySiteIdAndDate( $siteService->site_id, $date );


            $transaction = Yii::app()->db->beginTransaction();

            try
            {
                $positionForm->attributes = $_POST['PositionForm'];

                $valid = $positionForm->validate() && true;
                foreach (Factor::$labels as $system_id => $label)
                {
                    foreach ($params['phrases'] as $i => $phrase)
                    {
                        if( count($models) )
                        {
                            $factors = $phrases[$system_id]['phrases'][$i]->factors;
                            $phraseMeta = $phrases[$system_id]['phrases'][$i]->phraseMeta;

                            $phrases[$system_id]['phrases'][$i] = array_shift( $models );
                            $phrases[$system_id]['phrases'][$i]->factors = $factors;
                            $phrases[$system_id]['phrases'][$i]->phraseMeta = $phraseMeta;
                        }

                        $isNewRecord = $phrases[$system_id]['phrases'][$i]->isNewRecord;

                        $phrases[$system_id]['phrases'][$i]->attributes = $_POST['PositionInput'][$system_id . $i];
                        $phrases[$system_id]['phrases'][$i]->created_at = $positionForm->created_at;
                        $valid = $phrases[$system_id]['phrases'][$i]->save() && $valid;
                    }
                }

                if ($valid)
                {
                    $transaction->commit();

                    $message = $isNewRecord ? 'Сохранено' : 'Обновлено';
                    Yii::app()->user->setFlash('success', $message);
                }
            }
            catch (CException $e)
            {
                Yii::app()->user->setFlash('error', $e->getMessage() . ' Все изменения отменены.');
                $transaction->rollback();
            }
        }


        // Вывод формы
        $this->render('input', array(
            'site' => $site,
            'siteService' => $siteService,
            'phrases' => $phrases,
            'params' => $params,
            'positionForm' => $positionForm,
        ));
    }

    /**
     * @param $ssId SiteService->id param
     * @throws CHttpException
     * @return void
     */
    public function actionTerminate($ssId)
    {
        $model = SiteService::model()->findByPk($ssId);

        if (!$model) {
            throw new CHttpException(400, 'Такой услуги не подключено');
        }
        $terminateForm = new TerminateForm();

        if (isset($_POST['TerminateForm'])) {

            $terminateForm->attributes = $_POST['TerminateForm'];

            if ($terminateForm->validate()) {
                $model->attributes = $terminateForm->attributes;
                if (!$model->delete()) {
                    Yii::app()->user->setFlash('error', 'Ошибка отключения услуги');
                } else {
                    Yii::app()->user->setFlash('success', 'Сохранено');
                    $this->redirect(array('/admin/site/default/view', 'id' => $model->site_id));
                }
            }
        }

        $this->render('/shared/terminate', array(
            'model' => $model,
            'terminateForm' => $terminateForm,
        ));
    }
}

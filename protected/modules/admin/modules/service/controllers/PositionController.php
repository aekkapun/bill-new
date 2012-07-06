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
            $buf = array();
            foreach ($_POST['SitePhrase'] as $index => $attributes) {
                if (isset($phrases[$index])) {
                    $phrases[$index]->attributes = $attributes;
                    $valid = $phrases[$index]->validate() && $valid;
                }
            }

            if ($valid) {

                $params['phrases'] = $phrases;
                $params['factors'] = $factors;

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
        foreach (Factor::$labels as $system_id => $label) {
            $phrases[$system_id] = array(
                'name' => $label,
                'phrases' => array(),
            );
            foreach ($params['phrases'] as $i => $phrase) {
                $phrases[$system_id]['phrases'][$i] = new PositionInput();
                $phrases[$system_id]['phrases'][$i]->factors = $params['factors'];
                $phrases[$system_id]['phrases'][$i]->phraseMeta = $phrase;
                $phrases[$system_id]['phrases'][$i]->attributes = array(
                    'phrase' => $phrase['phrase'],
                    'hash' => $phrase['hash'],
                );
            }
        }

        if (isset($_POST['PositionInput']) && $_POST['PositionForm']) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                $positionForm->attributes = $_POST['PositionForm'];

                $valid = $positionForm->validate() && true;
                foreach (Factor::$labels as $system_id => $label) {
                    foreach ($params['phrases'] as $i => $phrase) {
                        $phrases[$system_id]['phrases'][$i]->attributes = $_POST['PositionInput'][$system_id . $i];
                        $phrases[$system_id]['phrases'][$i]->created_at = $positionForm->created_at;
                        $valid = $phrases[$system_id]['phrases'][$i]->save() && $valid;
                    }
                }
                if ($valid) {
                    $transaction->commit();
                    Yii::app()->user->setFlash('success', 'Сохранено');
                }
            } catch (CException $e) {
                Yii::app()->user->setFlash('error', $e->getMessage() . ' Все изменения отменены.');
                $transaction->rollback();
            }
        }

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

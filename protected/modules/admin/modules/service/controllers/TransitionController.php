<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/8/12
 * Time: 12:30 PM
 * To change this template use File | Settings | File Templates.
 */
class TransitionController extends Controller
{

    public function actionSubscribe($siteId)
    {
        $site = $this->loadSite($siteId);
        $service = Service::model()->findByPk(Service::TRANSITION);
        $siteService = new SiteService();
        $ranges = SiteRange::model()->findAllByAttributes(array(
            'site_id' => $siteId,
        ), array('index' => 'id'));

        if (!$ranges) {
            Yii::app()->user->setFlash('notice', 'Сначала нужно добавить диапазоны');
        }

        $transitionForm = new TransitionForm();

        if (isset($_POST['SiteService']) && isset($_POST['SiteRange']) && isset($_POST['TransitionForm'])) {
            $siteService->attributes = $_POST['SiteService'];
            $transitionForm->attributes = $_POST['TransitionForm'];

            $valid = $siteService->validate() && $transitionForm->validate();

            if ($valid) {
                $transaction = Yii::app()->db->beginTransaction();

                try {

                    $params['ranges'] = $ranges;
                    $params['maxSum'] = $transitionForm->sumMax;

                    $siteService->params = CJSON::encode($params);
                    if (!$siteService->save()) {
                        throw new CHttpException(500, 'Не удалось добавить услугу');
                    }

                    $transaction->commit();
                    $this->redirect(array('/admin/site/default/view', 'id' => $site->id));

                } catch (CException $e) {
                    $transaction->rollback();
                }
            }
        }

        $this->render('subscribe', array(
            'site' => $site,
            'service' => $service,
            'siteService' => $siteService,
            'transitionForm' => $transitionForm,
            'ranges' => $ranges,
        ));
    }

    public function actionInput($ssId)
    {
        $siteService = SiteService::model()->findByPk($ssId);
        $site = $this->loadSite($siteService->site_id);

        $params = CJSON::decode($siteService->params);

        $transitions = new TransitionInput();

        if (isset($_POST['TransitionInput'])) {
            $transitions->attributes = $_POST['TransitionInput'];
            if (!$transitions->save()) {
                Yii::app()->user->setFlash('error', 'Не удалось сохранить данные');
            } else {
                Yii::app()->user->setFlash('success', 'Сохранено');
            }
        }

        $this->render('input', array(
            'site' => $site,
            'siteService' => $siteService,
            'transitions' => $transitions,
            'params' => $params,
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

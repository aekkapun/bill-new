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

    public function actionInput($siteId)
    {
        $site = $this->loadSite($siteId);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
            'service_id' => Service::TRANSITION,
        ));
        $criteria->order = 'created_at DESC';

        $siteService = SiteService::model()->find($criteria);

        $params = CJSON::decode($siteService->params);

        $transitions = new TransitionInput();

        if(isset($_POST['TransitionInput'])) {
            $transitions->attributes = $_POST['TransitionInput'];
            if(!$transitions->save()) {
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

}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/8/12
 * Time: 4:17 PM
 * To change this template use File | Settings | File Templates.
 */
class SubscriptionController extends Controller
{

    public function actionSubscribe($siteId)
    {
        $site = $this->loadSite($siteId);
        $service = Service::model()->findByPk(Service::SUBSCRIPTION);
        $siteService = new SiteService();
        $subscriptionForm = new SubscriptionForm();

        if (isset($_POST['SiteService']) && isset($_POST['SubscriptionForm'])) {
            $siteService->attributes = $_POST['SiteService'];
            $subscriptionForm->attributes = $_POST['SubscriptionForm'];

            if ($subscriptionForm->validate()) {
                $params['sum'] = $subscriptionForm->sum;
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
            'subscriptionForm' => $subscriptionForm,
        ));
    }

    public function actionInput($siteId)
    {
        $site = $this->loadSite($siteId);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
            'service_id' => Service::SUBSCRIPTION,
        ));
        $criteria->order = 'created_at DESC';

        $siteService = SiteService::model()->find($criteria);

        $params = CJSON::decode($siteService->params);

        $subscriptionInput = new SubscriptionInput();

        if (isset($_POST['SubscriptionInput'])) {
            $subscriptionInput->attributes = $_POST['SubscriptionInput'];
            $subscriptionInput->params = $siteService->params;
            if (!$subscriptionInput->save()) {
                Yii::app()->user->setFlash('error', 'Не удалось сохранить данные');
            } else {
                Yii::app()->user->setFlash('success', 'Сохранено');
            }
        }

        $this->render('input', array(
            'site' => $site,
            'siteService' => $siteService,
            'params' => $params,
            'subscriptionInput' => $subscriptionInput,
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
                if (!$model->save()) {
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

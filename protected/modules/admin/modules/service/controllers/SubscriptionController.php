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

        if (isset($_POST['SiteService'])) {
            $siteService->attributes = $_POST['SiteService'];
            if ($siteService->save()) {
                $this->redirect(array('/admin/site/default/view', 'id' => $site->id));
            }
        }

        $this->render('subscribe', array(
            'site' => $site,
            'service' => $service,
            'siteService' => $siteService,
        ));
    }

    public function actionInput($siteId)
    {
        $site = $this->loadSite($siteId);

        $criteria = new CDbCriteria();
        $valueStart = date('Y-m-d', strtotime('first day of now'));
        $valueEnd = date('Y-m-d', strtotime('last day of now'));
        $criteria->addBetweenCondition('created_at', $valueStart, $valueEnd);
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
            'service_id' => Service::TRANSITION,
        ));

        $siteService = SiteService::model()->find($criteria);

        $subscriptionInput = new SubscriptionInput();

        if (isset($_POST['SubscriptionInput'])) {
            $subscriptionInput->attributes = $_POST['SubscriptionInput'];
            if (!$subscriptionInput->save()) {
                Yii::app()->user->setFlash('error', 'Не удалось сохранить данные');
            } else {
                Yii::app()->user->setFlash('success', 'Сохранено');
            }
        }

        $this->render('input', array(
            'valueStart' => $valueStart,
            'valueEnd' => $valueEnd,
            'site' => $site,
            'siteService' => $siteService,
            'subscriptionInput' => $subscriptionInput,
        ));
    }

}

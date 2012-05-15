<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/8/12
 * Time: 2:40 PM
 * To change this template use File | Settings | File Templates.
 */
class ContextController extends Controller
{
    public function actionSubscribe($siteId)
    {
        $site = $this->loadSite($siteId);
        $service = Service::model()->findByPk(Service::CONTEXT);
        $siteService = new SiteService();

        $advPlatforms = AdvPlatform::model()->findAll();
        $contextForm = new ContextForm();

        if (isset($_POST['SiteService']) && isset($_POST['ContextForm']) && isset($_POST['advPlatforms'])) {
            $siteService->attributes = $_POST['SiteService'];
            $contextForm->attributes = $_POST['ContextForm'];

            $valid = $siteService->validate() && $contextForm->validate();

            if ($valid) {
                $params['advPlatforms'] = $_POST['advPlatforms'];
                $params['budget'] = $contextForm->budget;
                $params['workPercent'] = $contextForm->workPercent;

                $siteService->params = CJSON::encode($params);

                if (!$siteService->save()) {
                    throw new CHttpException(500, 'Ну удалось подключить услугу');
                }

                $this->redirect(array('/admin/site/default/view', 'id' => $site->id));
            }
        }

        $this->render('subscribe', array(
            'site' => $site,
            'service' => $service,
            'siteService' => $siteService,
            'advPlatforms' => $advPlatforms,
            'contextForm' => $contextForm,
        ));
    }

    public function actionInput($siteId)
    {
        $site = $this->loadSite($siteId);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
            'service_id' => Service::CONTEXT,
        ));
        $criteria->order = 'created_at DESC';

        $siteService = SiteService::model()->find($criteria);

        $params = CJSON::decode($siteService->params);

        $contextInput = new ContextInput();

        if (isset($_POST['ContextInput'])) {
            $contextInput->attributes = $_POST['ContextInput'];
            $contextInput->params = $siteService->params;
            if (!$contextInput->save()) {
                Yii::app()->user->setFlash('error', 'Не удалось сохранить данные');
            } else {
                Yii::app()->user->setFlash('success', 'Сохранено');
            }
        }

        $this->render('input', array(
            'site' => $site,
            'siteService' => $siteService,
            'contextInput' => $contextInput,
            'params' => $params,
        ));
    }
}

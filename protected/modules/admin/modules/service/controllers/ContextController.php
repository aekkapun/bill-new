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

        $advPlatforms = AdvPlatform::model()->findAll(array('index' => 'id'));

        if (isset($_POST['SiteService']) && isset($_POST['advPlatforms'])) {

            $siteService->attributes = $_POST['SiteService'];

            $valid = $siteService->validate();

            foreach ($_POST['advPlatforms'] as $advPlatformId) {
                if (isset($_POST['AdvPlatform'][$advPlatformId])) {
                    $advPlatforms[$advPlatformId]->attributes = $_POST['AdvPlatform'][$advPlatformId];
                } else {
                    unset($advPlatforms[$advPlatformId]);
                }
                $valid = $valid && $advPlatforms[$advPlatformId]->validate();
            }

            $selectedPlatforms = array();

            foreach ($_POST['advPlatforms'] as $ap) {
                $selectedPlatforms[$ap] = true;
            }

            // Фильтруем только выбранные рекламные площадки
            $advPlatforms = array_intersect_key($advPlatforms, $selectedPlatforms);

            if ($valid) {

                $params = array();
                $params['advPlatforms'] = $advPlatforms;
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
        ));
    }

    public function actionInput($ssId)
    {

        $siteService = SiteService::model()->findByPk($ssId);
        $site = $this->loadSite($siteService->site_id);

        $params = CJSON::decode($siteService->params);

        $availableAdvPlatforms = array();

        foreach ($params['advPlatforms'] as $item) {
            $availableAdvPlatforms[$item['id']] = $item['name'];
        }

        $contextInput = new ContextInput();

        if (isset($_POST['ContextInput'])) {
            $contextInput->attributes = $_POST['ContextInput'];
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
            'availableAdvPlatforms' => $availableAdvPlatforms,
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

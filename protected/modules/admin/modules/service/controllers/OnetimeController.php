<?php
/**
 * Created by JetBrains PhpStorm.
 * User: IliyaGoloveshko
 * Date: 8/15/12
 * Time: 22:30 PM
 * To change this template use File | Settings | File Templates.
 */
class OnetimeController extends Controller
{

    public function actionSubscribe($siteId)
    {
        $site = $this->loadSite($siteId);
        $service = Service::model()->findByPk(Service::ONETIME);
        $siteService = new SiteService();
        $onetimeForm = new OnetimeForm();

        if (isset($_POST['SiteService']) && isset($_POST['OnetimeForm'])) {
            $siteService->attributes = $_POST['SiteService'];
            $onetimeForm->attributes = $_POST['OnetimeForm'];

            if ($onetimeForm->validate()) {
                $params['name'] = $onetimeForm->name;
                $params['cost'] = $onetimeForm->cost ? $onetimeForm->cost : 0;
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
            'onetimeForm' => $onetimeForm,
        ));
    }

    public function actionInput($ssId)
    {
        $siteService = SiteService::model()->findByPk($ssId);
        $site = $this->loadSite($siteService->site_id);

        $params = CJSON::decode($siteService->params);

        $this->render('input', array(
            'site' => $site,
            'siteService' => $siteService,
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

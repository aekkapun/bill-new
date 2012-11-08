<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/8/12
 * Time: 4:17 PM
 * To change this template use File | Settings | File Templates.
 */
class BannerController extends Controller
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
        $service = Service::model()->findByPk(Service::BANNERS);
        $siteService = new SiteService();
        $bannerForm = new BannerForm();

        if (isset($_POST['SiteService']) && isset($_POST['BannerForm'])) {
            $siteService->attributes = $_POST['SiteService'];
            $bannerForm->attributes = $_POST['BannerForm'];

            if ($bannerForm->validate()) {
                $params['budget'] = $bannerForm->budget;
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
            'bannerForm' => $bannerForm,
        ));
    }

    public function actionInput($ssId)
    {
        $siteService = SiteService::model()->findByPk($ssId);
        $site = $this->loadSite($siteService->site_id);

        $params = CJSON::decode($siteService->params);

        $bannerInput = new BannerInput();

        if (isset($_POST['BannerInput']))
        {
            $model = BannerInput::model()->findByAttributes(array(
                'site_id' => $_POST['BannerInput']['site_id'],
                'created_at' => $_POST['BannerInput']['created_at'],
            ));


            if( !empty($model) )
            {
                $bannerInput = $model;
            }

            $bannerInput->attributes = $_POST['BannerInput'];

            $isNewRecord = $bannerInput->isNewRecord;

            if ( $bannerInput->save() )
            {
                $message = $isNewRecord ? 'Сохранено' : 'Обновлено';
                Yii::app()->user->setFlash('success', $message);
            }
            else
            {
                Yii::app()->user->setFlash('error', 'Не удалось сохранить данные');
            }
        }

        $this->render('input', array(
            'site' => $site,
            'siteService' => $siteService,
            'params' => $params,
            'bannerInput' => $bannerInput,
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

                    // @TODO Move logs
                    $log = new ActionLog();
                    $log->attributes = array(
                        'action' => 'Отключена услуга &laquo;' . Service::getLabel($model->service_id) . '&raquo; c ' . $model->terminated_at,
                        'site_id' => $model->site_id,
                        'contract_id' => $model->contract_id,
                    );
                    $log->save();

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

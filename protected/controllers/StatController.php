<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/14/12
 * Time: 5:01 PM
 * To change this template use File | Settings | File Templates.
 */
class StatController extends Controller
{

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionSubscription($siteId)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));

        $dataProvider = new CActiveDataProvider('SubscriptionPeriod', array(
            'criteria' => $criteria
        ));

        $this->render('subscription', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionPosition($siteId)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));

        $dataProvider = new CActiveDataProvider('PositionPeriod', array(
            'criteria' => $criteria
        ));

        $this->render('position', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionTransition($siteId)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));

        $dataProvider = new CActiveDataProvider('TransitionPeriod', array(
            'criteria' => $criteria
        ));

        $this->render('transition', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionContext($siteId)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));

        $dataProvider = new CActiveDataProvider('ContextPeriod', array(
            'criteria' => $criteria
        ));

        $this->render('context', array(
            'dataProvider' => $dataProvider,
        ));
    }


//    public function actionView($serviceId, $siteId)
//    {
//
//        $criteria = new CDbCriteria();
//        $criteria->addColumnCondition(array(
//            'site_id' => $siteId,
//        ));
//
//        $viewName = Service::getControllerName($serviceId);
//        $modelName = ucfirst(Service::getControllerName($serviceId)) . 'Period';
//        $dataProvider = new CActiveDataProvider($modelName, array(
//            'criteria' => $criteria
//        ));
//
//        $this->render('view', array(
//            'dataProvider' => $dataProvider,
//            'viewName' => $viewName,
//        ));
//    }
}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/15/12
 * Time: 11:41 AM
 * To change this template use File | Settings | File Templates.
 */
class DetailController extends Controller
{
    public function actionSubscription($siteId, $from, $to)
    {
        $valueStart = date('Y-m-d H:i:s', $from);
        $valueEnd = date('Y-m-d H:i:s', $to);

        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition('created_at', $valueStart, $valueEnd);
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));

        $dataProvider = new CActiveDataProvider('SubscriptionInput', array(
            'criteria' => $criteria,
        ));

        $this->render('subscription', array(
            'dataProvider' => $dataProvider
        ));
    }

    public function actionPosition($siteId, $from, $to)
    {
        $valueStart = date('Y-m-d H:i:s', $from);
        $valueEnd = date('Y-m-d H:i:s', $to);

        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition('created_at', $valueStart, $valueEnd);
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));

        $totalSum = Yii::app()->db->createCommand()
            ->select('SUM(price)')
            ->from('position_input')
            ->where('site_id = :site_id and created_at BETWEEN :period_from and :period_to', array(':site_id' => $siteId, ':period_from' => $valueStart, ':period_to' => $valueEnd))
            ->queryScalar();

        $dataProvider = new CActiveDataProvider('PositionInput', array(
            'criteria' => $criteria,
        ));

        $this->render('position', array(
            'dataProvider' => $dataProvider,
            'totalSum' => $totalSum,
        ));
    }

    public function actionTransition($siteId, $from, $to)
    {
        $valueStart = date('Y-m-d H:i:s', $from);
        $valueEnd = date('Y-m-d H:i:s', $to);

        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition('created_at', $valueStart, $valueEnd);
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));


        $dataProvider = new CActiveDataProvider('TransitionInput', array(
            'criteria' => $criteria,
        ));

        $this->render('transition', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionContext($siteId, $from, $to)
    {
        $valueStart = date('Y-m-d H:i:s', $from);
        $valueEnd = date('Y-m-d H:i:s', $to);

        $criteria = new CDbCriteria();
        $criteria->addBetweenCondition('created_at', $valueStart, $valueEnd);
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));


        $dataProvider = new CActiveDataProvider('ContextInput', array(
            'criteria' => $criteria,
        ));

        $this->render('context', array(
            'dataProvider' => $dataProvider,
        ));
    }

}

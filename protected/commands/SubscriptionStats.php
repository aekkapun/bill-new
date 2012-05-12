<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/10/12
 * Time: 3:48 PM
 * To change this template use File | Settings | File Templates.
 */
class SubscriptionStats extends CConsoleCommand
{
    public function actionCount()
    {

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'service_id' => Service::SUBSCRIPTION,
        ));

        $siteServices = SiteService::model()->findAll($criteria);

        foreach ($siteServices as $siteService) {

            $subscriptionStat = SubscriptionStat::model()->findAll();

            if (!$subscriptionStat) {
                $criteria = new CDbCriteria();
            }
        }

    }
}

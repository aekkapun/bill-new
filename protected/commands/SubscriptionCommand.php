<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/10/12
 * Time: 3:48 PM
 * To change this template use File | Settings | File Templates.
 */
class SubscriptionCommand extends StatConsoleCommand
{

    protected $inputTable = 'subscription_input';

    protected function getNextPeriod($siteId)
    {
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));
        $criteria->order = 'period_begin DESC';
        $criteria->limit = 1;

        $model = SubscriptionPeriod::model()->find($criteria);

        if (empty($model)) {
            return FALSE;
        }

        return $model;
    }

    protected function createPeriod($timestamp, $siteId, $first = FALSE)
    {

        $bounds = $this->getPeriodBounds($timestamp, 30);

        $attributes = array(
            'period_begin' => (($first) ? Time::ts2dt($timestamp) : Time::ts2dt($bounds['begin'])),
            'site_id' => $siteId,
            'period_end' => Time::ts2dt($bounds['end']),
            'period_name' => $bounds['name'],
        );

        $subscriptionStat = new SubscriptionPeriod();
        $subscriptionStat->attributes = $attributes;

        return $subscriptionStat;
    }


    protected function countIndicators($period)
    {
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));

        $totalMonthLinkCount = Yii::app()->db->createCommand()
            ->from($this->inputTable)
            ->select('SUM(link_count)')
            ->where('(created_at BETWEEN :period_begin AND :period_end) and (site_id = :site_id)',
            array(
                ':period_begin' => $period->period_begin,
                ':period_end' => $period->period_end,
                ':site_id' => $period->site_id,
            ))
            ->queryScalar();

        $input = SubscriptionInput::model()->find($criteria);
        $params = CJSON::decode($input->params);

        $avgLinkPrice = round($params['sum'] / $totalMonthLinkCount, 2);

        return array(
            'avg_link_price' => $avgLinkPrice,
        );
    }
}

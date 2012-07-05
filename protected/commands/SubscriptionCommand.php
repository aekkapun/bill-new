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
    protected $inputClassName = 'SubscriptionInput';
    protected $periodClassName = 'SubscriptionPeriod';

    protected function countIndicators($period)
    {
        // select contract_id, sum(`link_count`) as link_count from subscription_input where site_id = 1 group by contract_id
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->select = 't.site_id, t.contract_id, SUM(t.link_count) as link_count';
        $criteria->group = 't.contract_id';

        $model = SubscriptionInput::model()->findAll($criteria);
        $indicators = array();

        foreach ($model as $data) {

            $params = $this->getPeriodParams($period, $data->contract_id);

            $avgLinkPrice = round($params['sum'] / $data['link_count'], 2);

            $indicators[] = array(
                'contract_id' => $data['contract_id'],
                'avg_link_price' => $avgLinkPrice,
            );
        }

        return $indicators;
    }
}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/10/12
 * Time: 3:48 PM
 * To change this template use File | Settings | File Templates.
 */
class BannerCommand extends StatConsoleCommand
{
    protected $inputClassName = 'BannerInput';
    protected $periodClassName = 'BannerPeriod';

    protected function countIndicators($period)
    {

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->select = 't.site_id, t.contract_id, SUM(t.sum) as sum, SUM(t.transitions) as transitions';
        $criteria->group = 't.contract_id';

        $model = BannerInput::model()->findAll($criteria);

        $indicators = array();

        foreach ($model as $data) {

            $params = $this->getPeriodParams($period, $data->contract_id);

            $avgTransitionPrice = round($data['sum'] / $data['transitions'], 2);

            $indicators[] = array(
                'contract_id' => $data['contract_id'],
                'avg_transition_price' => $avgTransitionPrice,
            );
        }

        return $indicators;
    }
}

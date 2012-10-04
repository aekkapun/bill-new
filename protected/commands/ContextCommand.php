<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/14/12
 * Time: 6:10 PM
 * To change this template use File | Settings | File Templates.
 */
class ContextCommand extends StatConsoleCommand
{

    protected $inputClassName = 'ContextInput';
    protected $periodClassName = 'ContextPeriod';

    protected function countIndicators($period)
    {

        $advPlatforms = AdvPlatform::model()->findAll();

        $indicators = array();

        foreach ($advPlatforms as $advPlatform) {

            $criteria = new CDbCriteria();
            $criteria->addColumnCondition(array(
                'site_id' => $period->site_id,
                'adv_platform_id' => $advPlatform->id,
            ));

            $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
            $criteria->select = 't.site_id, t.contract_id, AVG(t.avg_transition_price) as avg_transition_price, SUM(t.transitions_count) as transitions_count, SUM(t.transitions_sum) as transitions_sum';
            $criteria->group = 't.contract_id';

            $model = ContextInput::model()->findAll($criteria);

            foreach ($model as $data) {

                $indicators[] = array(
                    'contract_id' => $data['contract_id'],
                    'transitions_sum' => $data['transitions_sum'],
                    'avg_transition_price_per_day' => $data['avg_transition_price'],
                    'adv_platform_id' => $advPlatform->id,
                );
            }
        }

        return $indicators;
    }

}

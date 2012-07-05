<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/14/12
 * Time: 5:31 PM
 * To change this template use File | Settings | File Templates.
 */
class PositionCommand extends StatConsoleCommand
{
    protected $inputClassName = 'PositionInput';
    protected $periodClassName = 'PositionPeriod';

    protected function countIndicators($period)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->select = 'contract_id, SUM(t.price) as sum';
        $criteria->group = 't.contract_id';

        $model = PositionInput::model()->findAll($criteria);

        $indicators = array();

        foreach ($model as $data) {
            $indicators[] = array(
                'contract_id' => $data->contract_id,
                'sum' => $data->sum,
            );
        }

        return $indicators;
    }

}

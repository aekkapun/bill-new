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
        /*$criteria = new CDbCriteria;
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));

        $count = Yii::app()->db->createCommand()
            ->select('SUM(transitions_sum)')
            ->from($this->inputTable)
            ->where('site_id = :site_id and created_at BETWEEN :period_begin and :period_end', array(':site_id' => $period->site_id, ':period_begin' => $period->period_begin, ':period_end' => $period->period_end))
            ->queryScalar();

        return array(
            'transitions_sum' => $count,
        );*/

        //@todo
    }

}

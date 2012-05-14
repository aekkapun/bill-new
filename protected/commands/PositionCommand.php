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

    protected $inputTable = 'position_input';

    protected function createPeriod($timestamp, $siteId, $first = FALSE)
    {
        $bounds = $this->getPeriodBounds($timestamp, 30);

        $attributes = array(
            'period_begin' => (($first) ? Time::ts2dt($timestamp) : Time::ts2dt($bounds['begin'])),
            'site_id' => $siteId,
            'period_end' => Time::ts2dt($bounds['end']),
        );

        $subscriptionStat = new PositionPeriod();
        $subscriptionStat->attributes = $attributes;

        return $subscriptionStat;
    }

    protected function getNextPeriod($siteId)
    {
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));
        $criteria->order = 'period_begin DESC';
        $criteria->limit = 1;

        $model = PositionPeriod::model()->find($criteria);

        if (empty($model)) {
            return FALSE;
        }

        return $model;
    }

    protected function countIndicators($period)
    {
        print "\nНачинаем подсчет индикаторов:";
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));

        $count = Yii::app()->db->createCommand()
            ->select('SUM(price)')
            ->from($this->inputTable)
            ->where('site_id = :site_id and created_at BETWEEN :period_begin and :period_end', array(':site_id' => $period->site_id, ':period_begin' => $period->period_begin, ':period_end' => $period->period_end))
            ->queryScalar();

        return array(
            'sum' => $count,
        );

    }

}

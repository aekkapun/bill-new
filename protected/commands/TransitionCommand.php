<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/14/12
 * Time: 3:43 PM
 * To change this template use File | Settings | File Templates.
 */
class TransitionCommand extends StatConsoleCommand
{

    protected $inputTable = 'transition_input';

    protected function createPeriod($timestamp, $siteId, $first = FALSE)
    {
        $bounds = $this->getPeriodBounds($timestamp, 30);

        $attributes = array(
            'period_begin' => (($first) ? Time::ts2dt($timestamp) : Time::ts2dt($bounds['begin'])),
            'site_id' => $siteId,
            'period_end' => Time::ts2dt($bounds['end']),
            'period_name' => $bounds['name'],
        );

        $subscriptionStat = new TransitionPeriod();
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

        $model = TransitionPeriod::model()->find($criteria);

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

        $transitionCount = Yii::app()->db->createCommand()
            ->from($this->inputTable)
            ->select('SUM(transitions)')
            ->where('(created_at BETWEEN :period_begin AND :period_end) and (site_id = :site_id)',
            array(
                ':period_begin' => $period->period_begin,
                ':period_end' => $period->period_end,
                ':site_id' => $period->site_id,
            ))
            ->queryScalar();

        print "\nПереходов за месяц:" . $transitionCount;

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
            'service_id' => Service::TRANSITION,
        ));
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $siteService = SiteService::model()->find($criteria);

        $key = md5('transition' . $period->site_id . 'params');

        if ($siteService) {
            Yii::app()->setGlobalState($key, $siteService->params);
            $params = CJSON::decode($siteService->params);
        } else {
            $params = CJSON::decode(Yii::app()->getGlobalState($key));
        }
        print "\nИспользуемые параметры периода: " . $siteService->created_at;

        $ranges = array();
        foreach ($params['ranges'] as $range) {
            $meta = array();

            $meta['valueMin'] = $range['valueMin'];

            if ($range['valueMax'] != 0) {
                $meta['valueMax'] = $range['valueMax'];
            }
            $meta['price'] = $range['price'];
            $ranges[] = $meta;
        }

        $price = 0.0;
        foreach ($ranges as $range) {
            if (($transitionCount >= $range['valueMin'] && $transitionCount < $range['valueMax']) ||
                (!isset($range['valueMax']) && isset($range['valueMin']))
            ) {
                $price = $range['price'];
                break;
            }


        }
        print "\nЦена за переход: " . $price;
        $transitionSum = $price * $transitionCount;


        print "\nСумма за текущий период: " . $transitionSum;

        if ($transitionSum > $params['maxSum']) {
            $transitionSum = $params['maxSum'];
            print "\nСумма превышает максимальную для этого периода (" . $params['maxSum'] . "), корректируем: " . $transitionSum;
        }

        return array(
            'transition_sum' => $transitionSum,
            'transition_count' => $transitionCount,
        );
    }
}

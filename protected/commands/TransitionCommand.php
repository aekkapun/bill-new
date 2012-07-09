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

    protected $inputClassName = 'TransitionInput';
    protected $periodClassName = 'TransitionPeriod';

    protected function countIndicators($period)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
        ));
        $criteria->addBetweenCondition('created_at', $period->period_begin, $period->period_end);
        $criteria->select = 't.site_id, t.contract_id, SUM(t.transitions) as transitions';
        $criteria->group = 't.contract_id';

        $model = TransitionInput::model()->findAll($criteria);

        $indicators = array();

        foreach ($model as $data) {

            print "*** Поиск текущих параметров для договора с ID " . $data['contract_id'] . "\n";

            $params = $this->getPeriodParams($period, $data['contract_id'], Service::TRANSITION);

            if (!$params) {
                print "*** ERROR Найти не удалось";
            }

            $transitionsCount = floatval($data['transitions']);

            // Normalize ranges
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
                if (($transitionsCount >= $range['valueMin'] && $transitionsCount < $range['valueMax']) ||
                    (!isset($range['valueMax']) && isset($range['valueMin']))
                ) {
                    print "*** Входит в диапазон: " . $range['valueMin'] . "-" . (empty($range['valueMax']) ? 'inf' : $range['valueMax']) . "\n";
                    $price = $range['price'];
                    break;
                }
            }

            print "*** Цена за переход: " . $price . "\n";
            $transitionSum = $price * $transitionsCount;

            print "*** Сумма за текущий период: " . $transitionSum . "\n";

            if ($transitionSum > $params['maxSum']) {
                $transitionSum = $params['maxSum'];
                print "*** Сумма превышает максимальную для этого периода (" . $params['maxSum'] . "), корректируем: " . $transitionSum . "\n";
            }

            $indicators[] = array(
                'contract_id' => $data['contract_id'],
                'transition_sum' => $transitionSum,
                'transition_count' => $transitionsCount,
            );
        }

        return $indicators;
    }
}

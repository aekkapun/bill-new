<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/14/12
 * Time: 1:06 PM
 * To change this template use File | Settings | File Templates.
 */
abstract class StatConsoleCommand extends CConsoleCommand
{
    protected $inputTable;

    public function actionUpdate()
    {
        foreach ($this->siteIds as $siteId) {
            print "\n\n------------Сайт " . $siteId . "---------";
            print "\nСмотрим есть ли посчитанные периоды...";
            if (($currentPeriod = $this->getNextPeriod($siteId)) === FALSE) {
                print "нет, ищем минимальное время для начала счета";
                $currentPeriod = $this->createPeriod($this->getMinTime(), $siteId);
            }

            print "\nCчитаем";
            $this->countPeriod($currentPeriod);

            print "\nПроверяем, есть ли следующий период для подсчета...";
            while ($this->hasNextPeriodAfter($currentPeriod)) {
                print " есть";
                $currentPeriod = $this->createPeriod((strtotime($currentPeriod->period_end) + 1), $siteId);
                $this->countPeriod($currentPeriod);
            }
            print " нет, переходим к следующему сайту.\n";
        }
    }

    protected function hasNextPeriodAfter($period)
    {
        $db = Yii::app()->db;
        $row = null;

        $command = $db->createCommand()
            ->select('created_at')
            ->from($this->inputTable)
            ->where('created_at > :period_end and site_id = :site_id', array(':period_end' => $period->period_end, ':site_id' => $period->site_id))
            ->limit(1);

        $row = $command->queryColumn();

        if (!empty($row[0])) {
            return TRUE;
        }

        return FALSE;
    }

    protected function getSiteIds()
    {
        $command = Yii::app()->db->createCommand()
            ->select('site_id')
            ->from($this->inputTable);
        $command->distinct = true;
        $rows = $command->queryAll();
        $ids = array();
        foreach ($rows as $row) {
            $ids[] = $row['site_id'];
        }
        return $ids;
    }

    protected function getMinTime()
    {
        print "\nПолучаем минимальное время: ";
        $row = Yii::app()->db->createCommand()
            ->select('MIN(created_at)')
            ->from($this->inputTable)
            ->queryColumn();
        if (!empty($row[0])) {
            print " " . $row[0];
            return Time::dt2ts($row[0]);
        }
        print " FALSE";
        return FALSE;
    }

    /**
     * @param $timestamp
     * @return array
     */
    protected function getPeriodBounds($timestamp, $periodType = 1)
    {

        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);
        $maxInMonth = date('t', $timestamp);

        $bounds = array(
            'begin' => 0,
            'end' => 0,
            'name' => 'noname',
        );

        switch ($periodType) {
            // День
            case 1:
                $bounds['begin'] = mktime(0, 0, 0, $month, $day, $year);
                $bounds['end'] = mktime(23, 59, 59, $month, $day, $year);
                $bounds['name'] = Yii::app()->dateFormatter->formatDateTime($bounds['begin']);
                break;

            // Неделя
            case 7:
                $bounds['begin'] = strtotime(date('Y', $timestamp) . 'W' . date('W', $timestamp) . '1 00:00:00');
                $bounds['end'] = strtotime(date('Y', $timestamp) . 'W' . date('W', $timestamp) . '7 23:59:59');
                $bounds['name'] = date('d-m-Y', $bounds['begin']) . ' - ' . date('d-m-Y', $bounds['end']);
                //Yii::app()->dateFormatter->formatDateTime()
                break;

            // Месяц
            case 30:
                $bounds['begin'] = mktime(0, 0, 0, $month, 1, $year);
                $bounds['end'] = mktime(23, 59, 59, $month, $maxInMonth, $year);
                $bounds['name'] = Yii::app()->dateFormatter->format('LLLL y', $bounds['begin']);

                break;
        }
        return $bounds;
    }


    protected function countPeriod($period)
    {
        $indicators = $this->countIndicators($period);
        $period->attributes = $indicators;
        $period->save();
    }

    protected abstract function countIndicators($period);

}

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

    protected $inputClassName;
    protected $periodClassName;

    public function actionUpdate()
    {
        foreach ($this->getAllSitesData() as $site) {

            print "---\nРасчет показателей для сайта id=" . $site->site_id . "\n";
            print "** Смотрим есть ли посчитанные периоды: ";
            if (($currentPeriod = $this->getNextPeriod($site->site_id)) === false) {

                print "нет, получаем минимально возможное время для начала счета статистики:";

                $minTime = $this->getMinTime();
                $currentPeriod = $this->createPeriod($minTime, $site->site_id);

                print " " . Yii::app()->dateFormatter->format('dd MMMM y', $minTime) . "\n";

                print "** Cчитаем\n";
                $this->countPeriod($currentPeriod);
            } else {
                print "есть\n";
            }

            print "** Проверяем, есть ли следующий период для подсчета: ";
            while ($this->hasNextPeriodAfter($currentPeriod)) {
                print " есть";
                $currentPeriod = $this->createPeriod((strtotime($currentPeriod->period_end) + 1), $site->site_id);
                $this->countPeriod($currentPeriod);
            }

            print "нет, переходим к следующему сайту.\n\n";
            print "Расчет для сайта id=" . $site->site_id . " закончен\n";
            print "---\n\n";
            flush();
        }
    }

    protected function getNextPeriod($siteId)
    {
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(array(
            'site_id' => $siteId,
        ));
        $criteria->order = 'period_begin DESC';
        $criteria->limit = 1;

        $component = Yii::createComponent(array('class' => $this->periodClassName));
        $model = $component->find($criteria);

        if (empty($model)) {
            return false;
        }

        return $model;
    }

    protected function createPeriod($timestamp, $siteId, $first = false)
    {
        $bounds = $this->getPeriodBounds($timestamp, 30);

        $attributes = array(
            'period_begin' => (($first) ? Time::ts2dt($timestamp) : Time::ts2dt($bounds['begin'])),
            'site_id' => $siteId,
            'period_end' => Time::ts2dt($bounds['end']),
            'period_name' => $bounds['name'],
        );

        $model = Yii::createComponent(array('class' => $this->periodClassName));
        $model->attributes = $attributes;

        return $model;
    }

    protected function hasNextPeriodAfter($period)
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('created_at > "' . $period->period_end . '"');
        $criteria->addColumnCondition(array('site_id' => $period->site_id));
        $criteria->limit = 1;

        $model = Yii::createComponent(array('class' => $this->inputClassName));
        $status = $model->find($criteria);

        return ($status === NULL) ? false : true;
    }

    protected function getAllSitesData()
    {
        $component = Yii::createComponent(array('class' => $this->inputClassName));

        $criteria = new CDbCriteria();
        $criteria->group = 't.site_id';

        $model = $component->findAll($criteria);
        return $model;
    }

    protected function getMinTime()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'MIN(t.created_at) as created_at';
        $criteria->limit = 1;

        $component = Yii::createComponent(array('class' => $this->inputClassName));
        $model = $component->find($criteria);

        return ($model) ? Time::dt2ts($model->created_at) : false;
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
        $result = $this->countIndicators($period);

        // Assume that indicators are array of arrays for multiple contract_id support
        foreach ($result as $indicator) {
            if (!is_array($indicator)) {
                $result = array($result);
            }
            break;
        }

        foreach ($result as $indicators) {
            $model = Yii::createComponent(array('class' => $this->periodClassName));
            $model->attributes = CMap::mergeArray($period->attributes, $indicators);
            $model->save();
        }
    }

    protected function getPeriodParams($period, $contract_id)
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'site_id' => $period->site_id,
            'contract_id' => $contract_id,
            'service_id' => Service::SUBSCRIPTION,
            'enabled' => 1,
        ));
        $criteria->order = 'created_at DESC';

        $siteService = SiteService::model()->find($criteria);

        $params = CJSON::decode($siteService->params);

        return $params;
    }


    protected abstract function countIndicators($period);

}

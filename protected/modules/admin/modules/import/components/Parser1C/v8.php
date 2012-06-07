<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 10/26/11
 * Time: 1:44 PM
 * To change this template use File | Settings | File Templates.
 */

Yii::import('application.modules.import.components.Parser1C.SectionFilter');

class Parser1C_v8 extends CComponent
{
    public $rawData = null;

    /**
     * @param $string
     * @return array|null
     */
    public function parse($string)
    {
        if ($this->rawData !== null) {
            return $this->rawData;
        }

        //Разбиваем весь документ на секции
        preg_match_all('/[\r\n]СекцияДокумент=.*[\r\n]([а-я0-9]+=.+[\r\n])+КонецДокумента/ui', $string, $matches);

        if (empty($matches[0])) {
            return null;
        }

        //$result = array();
        foreach ($matches[0] as $index => $section) {
            $section = trim($section);

            //Разбиваем секции на строки в формате [\w]+-.+[\r\n]
            preg_match_all('|([а-я0-9]+=.+[\r\n])|ui', $section, $strings);

            if (!isset($strings[0])) {
                return null;
            }

            $this->rawData[$index] = array();

            foreach ($strings[0] as $string) {
                $string = trim($string);
                $buf = explode('=', $string);
                $idx = md5(trim($buf[0]));
                $idxRaw = trim($buf[0]);
                $value = trim($buf[1]);
                $this->rawData[$index][$idxRaw] = $value;
                $this->rawData[$index][$idx] = $value;
            }
        }

        return $this->rawData;
    }

    public function parseIncomeTransactions($string)
    {
        return $this->applyFilter($string, array('SectionFilter', 'filterIncome'));
    }

    public function parseOutgoingTransactions($string)
    {
        return $this->applyFilter($string, array('SectionFilter', 'filterOutgoing'));
    }

    public function parseIncomeTransactionsForAccount($string, $accountNumber)
    {
        $filters = array(
            array('SectionFilter', 'filterIncome'),
            array('SectionFilter', 'filterAccountNumber'),
        );
        return $this->applyFilters($string, $filters, array('accountNumber' => $accountNumber));
    }

    protected function applyFilter($string, $callback, array $params = array())
    {
        $data = $this->parse($string);

        $filterClass = $callback[0];
        $filterMethod = $callback[1];
        $filter = new $filterClass($data);
        $filter->setParams($params);

        if ($data !== null) {
            return array_filter($data, array($filter, $filterMethod));
        }
    }

    protected function applyFilters($string, array $filters, array $params = array())
    {
        $result = array();
        foreach ($filters as $filter) {
            $result = $this->applyFilter($string, $filter, $params);
        }
        return $result;
    }
}

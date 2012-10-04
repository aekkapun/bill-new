<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 11/14/11
 * Time: 3:12 PM
 * To change this template use File | Settings | File Templates.
 */

class SectionFilter
{

    private $_params;

    private $_availableParams = array('accountNumber');

    public function setParam($index, $value, $overwrite = false)
    {
        if (in_array($index, $this->_availableParams)) {
            if (!isset($this->_params) || $overwrite === true) {
                $this->_params[$index] = $value;
            }
        }
    }

    public function setParams(array $params)
    {
        foreach ($params as $index => $value) {
            $this->setParam($index, $value);
        }
    }

    public function filterIncome($data)
    {
        $key = md5('ДатаПоступило');
        return array_key_exists($key, $data);
    }

    public function filterOutgoing($data)
    {
        $key = md5('ДатаСписано');
        return array_key_exists($key, $data);
    }

    public function filterAccountNumber($data)
    {
        assert(isset($this->_params['accountNumber']));
        $key = md5('ПолучательРасчСчет');
        return (array_key_exists($key, $data) && $data[$key] == $this->_params['accountNumber']);
    }

}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ilya
 * Date: 09.10.12
 * Time: 16:34
 * To change this template use File | Settings | File Templates.
 */

class TotalColumn extends CDataColumn {

    private  $_total = 0;


    public function renderDataCellContent($row, $data)
    {
        $this->_total += $data->{$this->name};

        echo $data->{$this->name};

    }


    public  function renderFooterCellContent()
    {
        echo CHtml::tag('strong', array(), $this->_total);
    }

}
?>

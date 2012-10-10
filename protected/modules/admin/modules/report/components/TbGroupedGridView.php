<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ilya
 * Date: 09.10.12
 * Time: 16:34
 * To change this template use File | Settings | File Templates.
 */

class TbGroupedGridView extends TbGridView {

    public $groupField;

    public $sectionList = array();

    public $sectionRowClass = 'section-row';

    private $_breakLines = array();


    public function init()
    {
        parent::init();


        foreach( $this->dataProvider->data as $row => $item )
        {
            // Значение, по которому должны разбиваться строки
            $groupValue = $item[$this->groupField];


            // Если текущую строку нужно разбить - то добавляем в массив $this->_breakLines данные, которые в последствие нужно вывести в строке
            if( isset($this->sectionList[$groupValue] ) )
            {
                $this->_breakLines[$row] = $this->sectionList[$groupValue];

                unset($this->sectionList[$groupValue]);
            }
        }

    }


    public function renderTableRow($row)
    {
        if( isset( $this->_breakLines[$row] ) )
        {
            echo '<tr class="' . $this->sectionRowClass . '">';

            foreach( $this->columns as $column )
            {
                if( array_key_exists($column->name, $this->_breakLines[$row]) )
                {
                    echo '<td>' . $this->_breakLines[$row][$column->name] . '</td>';
                }
                else
                {
                    echo "<td></td>";
                }
            }

            echo "</tr>\n";
        }

        parent::renderTableRow($row);
    }




}
?>

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 07.11.12
 * Time: 12:29
 */
require dirname(__FILE__) . '/LiveServiceAction.php';

class GetDataByDateAction extends LiveServiceAction
{
    public function run( $ssId, $date )
    {
        $modelName = $this->_getModelName();

        $data = $modelName::getDataByDate( $ssId, $date );

        echo CJSON::encode( $data );

        Yii::app()->end();
    }
}

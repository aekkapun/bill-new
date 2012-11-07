<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 07.11.12
 * Time: 12:19
 */
require dirname(__FILE__) . '/LiveServiceAction.php';

class GetFilledDaysAction extends LiveServiceAction
{
    public function run( $ssId )
    {
        $modelName = $this->_getModelName();

        $siteService = SiteService::model()->findByPk( $ssId );

        $models = $modelName::model()->findAllByAttributes(array(
            'site_id' => $siteService->site_id
        ));


        $filledDays = array();

        foreach( $models as $model )
        {
            $date = date('Y-m-d', strtotime($model->created_at));
            $filledDays[] = $date;
        }

        $filledDays = array_values( array_unique( $filledDays ) );


        echo CJavaScript::encode( $filledDays );
        Yii::app()->end();
    }
}

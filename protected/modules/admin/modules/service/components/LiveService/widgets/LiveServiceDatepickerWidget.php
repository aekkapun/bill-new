<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 07.11.12
 * Time: 12:51
 */

Yii::import('zii.widgets.jui.CJuiDatePicker');

class LiveServiceDatepickerWidget extends CJuiDatePicker
{
    public $serviceName;
    public $ssId;



    public function init()
    {
        $this->_registerAssets();

        $this->language = 'ru';

        $this->options = array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd',
            'showOn' => 'button',
            'buttonImage' => '/images/calendar.png',
            'buttonImageOnly' => true,
            'numberOfMonths' => 2,
            'showCurrentAtPos' => 1,
            'beforeShowDay' => 'js:liveService.highlight',
            'onSelect'   => "js:liveService.getDataByDate"
        );

        return parent::init();
    }


    public function run()
    {
        $options = array(
            'serviceName' => ucfirst( $this->serviceName ),
            'ssId' => $this->ssId,
        );

        $jsOptions = CJSON::encode( $options );

        Yii::app()->clientScript->registerScript( 'liveServiceInit', "liveService.init( $jsOptions );", CClientScript::POS_HEAD );

        return parent::run();
    }


    private function _registerAssets()
    {
        $assets = dirname(__FILE__).'/assets';

        $baseUrl = Yii::app()->assetManager->publish($assets, false, -1, YII_DEBUG);

        Yii::app()->clientScript->registerScriptFile( $baseUrl . '/js/script.js', CClientScript::POS_HEAD );
        Yii::app()->clientScript->registerCssFile( $baseUrl . '/css/style.css' );
    }
}

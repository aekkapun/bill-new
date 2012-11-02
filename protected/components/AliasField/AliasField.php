<?php
/**
 * Add disabled field to form, automatic filling from $source field, but filing by tranliteration text.
 * Spaces change on $divider. Other trash will deleting
 * In $source field you can set simple name of soure attribute
 *
 * Добавляет disabled поле в форму, автоматически заполняемую текстом из поля $source, транслитерируя
 * перед этим текст из поля $source. Нетекстовые символы и прочий мусор удаляются
 * Обязательный параметр `source` - имя атрибута источника
 *
 * Render input and input[type=hidden], because jquery.serialize ignore disabled inputs
 *
 * Скрытое поле выводится для того, что бы сохранить валидацию, т.к. jquery.serialize игнорирует disabled поля
 *
 */
class AliasField extends CWidget
{
    public $source;
    public $destination;
    public $separator = '-';




    public function init()
    {
        parent::init();

        $this->_registerAssets();
    }


    public function run()
    {
        $options = CJavaScript::encode(array(
            'destination'  => $this->destination,
            'urlSeparator' => $this->separator
        ));


        Yii::app()->clientScript->registerScript(
            $this->source . '_alias',
            "$('{$this->source}').syncTranslit({$options});"
        );

    }


    private function _registerAssets()
    {
        $assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets');

        Yii::app()->getClientScript()->registerScriptFile($assets . '/js/jquery.synctranslit.js');
    }
}
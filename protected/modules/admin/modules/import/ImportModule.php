<?php

class ImportModule extends CWebModule
{

    public $availableAdapters = array(
        'phraseImport' => 'Импорт из файла CSV списка запросов',
        'positionImport' => 'Импорт из файла CSV позиций по запросам',
    );

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'import.models.*',
            'import.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

    public function getAvailableDriversForCMenu()
    {
        $items = array();
        foreach ($this->availableAdapters as $src => $label) {
            $items[] = array(
                'label' => $label,
                'url' => array('/admin/import/default/index', 'src' => $src),
            );
        }

        return $items;
    }
}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Goloveshko Iliya
 * Date: 30.10.12
 * Time: 10:33
 */
class InputStaticIndex extends CWidget
{

    public $siteId;

    public $emptyValue = '-';

    private $_dataProvider;




    public function init()
    {
        Yii::import('application.modules.admin.modules.staticIndex.models.*');

        $indexes = $this->_generateIndexes();

        $this->_generateDataProvider( $indexes );
    }


    public function run()
    {
        $this->render('view', array('dataProvider' => $this->_dataProvider));

        $this->render('_modal', array(
            'model' => new StaticIndexInput,
        ));
    }


    private function _generateDataProvider( $indexes )
    {
        $fields = array();

        foreach( StaticIndex::model()->findAll() as $model )
        {
            $fields[] = array(
                'name'         => $model->name,
                'title'        => $model->title,
                'inputDate'    => $indexes[$model->name]['inputDate'],
                'currentValue' => $indexes[$model->name]['currentValue'],
                'lastValue'    => $indexes[$model->name]['lastValue'],
                'inputButton'  => $this->_generateInputButton( $model->id, $model->title ),
            );
        }

        $this->_dataProvider = new CArrayDataProvider( $fields );
        $this->_dataProvider->keyField = 'name';
    }


    private function _generateIndexes()
    {
        return StaticIndexInput::getIndexes( $this->siteId, $this->emptyValue );
    }


    private function _generateInputButton( $indexId, $indexTitle )
    {
        $htmlOptions = array(
            'class'            => 'btn btn-mini static-input-button',
            'data-site-id'     => $this->siteId,
            'data-index-id'    => $indexId,
            'data-index-title' => $indexTitle,
            'data-toggle'      => 'modal',
            'data-target'      => '#modal_window',
        );

        return CHtml::tag(
            'button',
            $htmlOptions,
            '<i class="icon-pencil"></i>'
        );
    }

}

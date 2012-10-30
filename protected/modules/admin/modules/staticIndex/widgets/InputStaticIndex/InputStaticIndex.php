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

    private $_dataProvider;




    public function init()
    {
        Yii::import('application.modules.admin.modules.staticIndex.models.*');

        $this->_registerCss();

        $indexes = $this->_generateIndexes();

        $this->_generateDataProvider( $indexes );
    }


    public function run()
    {
        $this->render('view', array('dataProvider' => $this->_dataProvider));
    }


    private function _generateDataProvider( $indexes )
    {
        $fields = array();

        foreach( StaticIndex::model()->findAll() as $model )
        {
            $fields[] = array(
                'name'         => $model->name,
                'index'        => $model->title,
                'inputDate'    => date( 'd.m.Y', strtotime($indexes[$model->name]['inputDate'])),
                'currentValue' => $indexes[$model->name]['currentValue'],
                'lastValue'    => $indexes[$model->name]['lastValue'],
                'inputButton'  => $this->_generateInputButton( $model->id ),
            );
        }

        $this->_dataProvider = new CArrayDataProvider( $fields );
        $this->_dataProvider->keyField = 'name';
    }


    private function _generateIndexes()
    {
        return StaticIndexInput::getIndexes( $this->siteId );
    }


    private function _generateInputButton( $indexId )
    {
        return CHtml::tag(
            'button',
            array(
                'class' => 'btn btn-mini static-input-button',
                'data-site-id' => $this->siteId,
                'data-index-id' => $indexId,
            ),
            '<i class="icon-pencil"></i>'
        );
    }


    private function _registerCss()
    {
        Yii::app()->clientScript->registerScript('static_index_input_button', "
            $('.static-input-button').bind('click', function(){

                $.ajax({
                    url  : '/admin/staticIndex/staticIndexInput/input',
                    data : {
                        siteId : $(this).data('site-id'),
                        indexId : $(this).data('index-id'),
                    }
                })
                .success(function(){

                })
                .fail(function(){
                    alert('fail');
                });
            });
        ");
    }


}

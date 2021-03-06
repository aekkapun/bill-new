<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Admin
 * Date: 28.10.12
 * Time: 22:41
 * To change this template use File | Settings | File Templates.
 */
class FilesTable extends CWidget
{
    public $model;


    public function init()
    {
        Yii::app()->clientScript->registerScript('report_table_handler', "
            function report_table_handler() {
                handler = {
                    select          : $('#Report_client_id'),
                    submitButton    : $('#report-form button[type=submit]'),

                    disable         : function() {
                        this.select.attr( 'disabled', 'disabled' );
                        this.submitButton.attr( 'disabled', 'disabled' );
                        this.select.loading(true, 'after');
                    },

                    enable          : function() {
                        this.select.removeAttr( 'disabled' );
                        this.submitButton.removeAttr( 'disabled' );
                        this.select.loading(false, 'after');
                    },

                    loadFiles       : function() {
                        $.get('/admin/report/report/getAllClientFiles', {clientId: handler.select.val()})
                         .done(function( data ) {
                            $('#files_area').show();
                            $('#files_table').html(data);
                            handler.enable();
                        })
                        .fail(function( xhr, status, error) {
                            alert(error);
                            handler.enable();
                        });
                    }
                }

                handler.disable();
                handler.loadFiles();
            }
        ", CClientScript::POS_HEAD);


        if( isset($this->model->client_id) )
        {
            Yii::app()->clientScript->registerScript('report_table_trigger', "
                report_table_handler();
            ");
        }


        Yii::app()->clientScript->registerScript('report_table', "
            $('#Report_client_id').bind('change', report_table_handler);
        ");
    }

    public function run()
    {
        $this->render('view', array());
    }


}

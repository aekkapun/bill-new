<?php

class StaticIndexInputController extends Controller
{
	public $layout='//layouts/column2';


	public function filters()
	{
		return array(
			'postOnly + delete',
		);
	}


	public function actionCreate()
	{
        $response = array();

        if (isset($_POST['StaticIndexInput']))
        {
            $model = new StaticIndexInput;
            $model->attributes = $_POST['StaticIndexInput'];

            if ($model->save())
            {
                $response = array(
                    'indexName' => $model->name,
                    'status' => 'success',
                    'data' => 'Данные были успешно сохранены'
                );
            }
            else
            {
                $response = array(
                    'status' => 'error',
                    'data' => CHtml::errorSummary( $model ),
                );
            }
        }
        else
        {
            exit(json_encode(array(
                    'status' => 'error',
                    'data' => 'Необходимо ввести данные.',
            )));
        }

        exit(json_encode( $response ));
    }


    public function actionGetIndex( $siteId, $indexName )
    {
        $indexes = StaticIndexInput::getIndex( $siteId, $indexName );

        exit(json_encode( $indexes ));
    }


    public function actionValidate()
    {
        if(isset($_POST['StaticIndexInput']))
        {
            $model = new StaticIndexInput();
			$model->attributes=$_POST['StaticIndexInput'];

            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


	public function loadModel($id)
	{
		$model=StaticIndexInput::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


}

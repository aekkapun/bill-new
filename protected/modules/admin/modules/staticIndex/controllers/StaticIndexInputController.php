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


	public function actionInput( $siteId, $indexId )
	{
        $model=new StaticIndexInput;

		$this->performAjaxValidation($model);

		if(isset($_POST['StaticIndexInput']))
		{
            /*
			$model->attributes=$_POST['StaticIndexInput'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
            */
		}

        if( Yii::app()->request->isAjaxRequest)
        {
            $response = array(
                'header' => StaticIndex::model()->findByPk( $indexId )->title,
                'body' => $this->renderPartial('_input',array('model'=>$model), true),
            );

            echo CJSON::encode( $response );
            die();
        }
        else
        {
            $this->render('_input',array('model'=>$model));
        }
	}


	public function loadModel($id)
	{
		$model=StaticIndexInput::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='static-index-input-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

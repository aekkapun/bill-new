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


	public function actionInput()
	{
		$model=new StaticIndexInput;

		$this->performAjaxValidation($model);

		if(isset($_POST['StaticIndexInput']))
		{
			$model->attributes=$_POST['StaticIndexInput'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

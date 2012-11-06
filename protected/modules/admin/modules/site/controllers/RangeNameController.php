<?php

class RangeNameController extends Controller
{

	public function actionCreate()
	{
		$model=new RangeName;

		if(isset($_POST['RangeName']))
		{
			$model->attributes=$_POST['RangeName'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RangeName']))
		{
			$model->attributes=$_POST['RangeName'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


    public function actionIndex()
	{
		$model=new RangeName('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RangeName']))
			$model->attributes=$_GET['RangeName'];

        $this->render('index',array(
			'model'=>$model,
		));
	}


    public function loadModel($id)
	{
		$model=RangeName::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}

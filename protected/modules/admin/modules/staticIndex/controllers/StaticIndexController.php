<?php

class StaticIndexController extends Controller
{

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionCreate()
	{
		$model=new StaticIndex;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['StaticIndex']))
		{
			$model->attributes=$_POST['StaticIndex'];
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

		$this->performAjaxValidation($model);

		if(isset($_POST['StaticIndex']))
		{
			$model->attributes=$_POST['StaticIndex'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


    public function actionIndex()
    {
        $model=new StaticIndex('search');
        $model->unsetAttributes();

        if(isset($_GET['StaticIndex']))
        {
            $model->attributes=$_GET['StaticIndex'];
        }

        $this->render('index',array(
            'model'=>$model,
        ));
    }


    public function loadModel($id)
	{
		$model=StaticIndex::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='static-index-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

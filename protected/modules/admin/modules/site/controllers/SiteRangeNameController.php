<?php

class SiteRangeNameController extends Controller
{

	public function actionCreate()
	{
		$model = new SiteRangeName;

		if(isset($_POST['SiteRangeName']))
		{
			$model->attributes=$_POST['SiteRangeName'];
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

		if(isset($_POST['SiteRangeName']))
		{
			$model->attributes=$_POST['SiteRangeName'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
        if( ($id == SiteRangeName::DEFAULT_NAME_ID)  || !Yii::app()->request->isPostRequest)
        {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        // we only allow deletion via POST request
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}


    public function actionIndex()
	{
		$model = new SiteRangeName('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SiteRangeName']))
			$model->attributes=$_GET['SiteRangeName'];

        $this->render('index',array(
			'model'=>$model,
		));
	}


    public function loadModel($id)
	{
		$model = SiteRangeName::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    public function actionGetNamesOptions( )
    {
        $siteId = Yii::app()->request->getQuery( 'siteId' );

        $namesIDs = SiteRangeName::getNamesBySiteId( $siteId );

        $options = CHtml::listOptions( null, $namesIDs, $emptyHtmlOptions);

        echo $options;
        Yii::app()->end();
    }

}

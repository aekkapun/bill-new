<?php

class SitePhraseGroupController extends Controller
{

	public function actionCreate()
	{
		$model = new SitePhraseGroup();

		if(isset($_POST['SitePhraseGroup']))
		{
			$model->attributes=$_POST['SitePhraseGroup'];
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

		if(isset($_POST['SitePhraseGroup']))
		{
			$model->attributes=$_POST['SitePhraseGroup'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
        if( ($id == SitePhraseGroup::DEFAULT_NAME_ID)  || !Yii::app()->request->isPostRequest)
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
		$model = new SitePhraseGroup('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SitePhraseGroup']))
			$model->attributes=$_GET['SitePhraseGroup'];

        $this->render('index',array(
			'model'=>$model,
		));
	}


    public function loadModel($id)
	{
		$model = SitePhraseGroup::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


    public function actionGetGroupsOptions( )
    {
        $siteId = Yii::app()->request->getQuery( 'siteId' );

        $groupsIDs = SitePhraseGroup::getGroupsBySiteId( $siteId );

        $options = CHtml::listOptions( null, $groupsIDs, $emptyHtmlOptions);

        echo $options;
        Yii::app()->end();
    }

}

<?php

class PhraseController extends Controller
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new SitePhrase;
        $model->site_id = Yii::app()->request->getQuery('siteId');

        if (isset($_POST['SitePhrase'])) {
            $model->attributes = $_POST['SitePhrase'];
            if ($model->save())
                $this->redirect(array('index', 'SitePhrase[site_id]' => $model->site_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SitePhrase'])) {
            $model->attributes = $_POST['SitePhrase'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

	/**
     * Deletes all phrases.
     * @param integer $modelId the ID of the site model 
     */
    public function actionDeleteAll($siteId)
    {
		$success = SitePhrase::model()->deleteAll('site_id = :siteId', array(':siteId' => $siteId));
		
		if ($success)
		{
			Yii::app()->user->setFlash('success', 'Все запросы успешно удалены');
		}
		else
		{
			Yii::app()->user->setFlash('error', 'При удалении запросов произошла ошибка');
		}
		
		$this->redirect(array('//admin/site/default/view','id'=>$siteId));
    }
	
    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new SitePhrase('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['SitePhrase']))
            $model->attributes = $_GET['SitePhrase'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionImport()
    {

    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = SitePhrase::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-phrase-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

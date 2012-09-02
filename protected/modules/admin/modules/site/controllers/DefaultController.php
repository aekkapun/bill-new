<?php

class DefaultController extends Controller
{

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('create', 'update'),
                'roles' => array('admin'),
            ),
            array('allow',
                'actions' => array('view', 'index'),
                'roles' => array('manager'),
            ),

            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        /*$command = Yii::app()->db->createCommand();
        $inlineCommand = Yii::app()->db->createCommand()
            ->from('site_service')
            ->where('site_id = :site_id AND enabled=1')
            ->order('created_at DESC')->getText();
        $command->from('(' . $inlineCommand . ') t1');
        $command->group('service_id');

        $services = $command->queryAll(true, array(':site_id' => $id));

        $services = SiteService::model()->findAllByAttributes(array(
            'enabled' => 1,
            'site_id' => $id,
        ), array(
            'order' => 'created_at DESC'
        ));*/

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'sitePhrases' => SitePhrase::model()->siteOf($id)->searchAsArray(),
            'siteRanges' => SiteRange::model()->siteOf($id)->searchAsArray(),
            'services' => SiteService::model()->siteOf($id)->enabled()->searchAsArray(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Site;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Site'])) {
            $model->attributes = $_POST['Site'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionLog($id)
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'updated_at DESC';
        $criteria->addColumnCondition(array(
            'site_id' => $id,
        ));

        $dataProvider = new CActiveDataProvider('ActionLog', array(
            'criteria' => $criteria
        ));

        $this->render('log', array(
            'dataProvider' => $dataProvider,
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

        if (isset($_POST['Site'])) {
            $model->attributes = $_POST['Site'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new Site('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Site']))
            $model->attributes = $_GET['Site'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = Site::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

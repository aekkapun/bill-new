<?php

class ClientController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl -ajaxDependsOfClient'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('create', 'update'),
                'roles' => array('accountant'),
            ),
            array('allow',
                'actions' => array('index', 'view'),
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
        $model = new Client;

        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
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

        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new Client('search');
        $model->unsetAttributes(); // clear any default values
        $model->my();

        if (isset($_GET['Client']))
            $model->attributes = $_GET['Client'];

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
        $model = Client::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'client-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionAjaxDependsOfClient()
    {
        $city_id = Yii::app()->request->getPost('id');
        $model = Client::model()->with('contracts')->findByPk($city_id);

        $contracts = array();
        if (count($model->contracts)) {
            $htmlOptions = array();
            $contracts = CHtml::listOptions(null, CHtml::listData($model->contracts, 'id', 'number'), $htmlOptions);
        }

        print CJSON::encode(array(
            'contracts' => $contracts,
        ));
    }
}

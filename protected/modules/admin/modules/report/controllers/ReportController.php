<?php

class ReportController extends Controller
{

    public function filters()
    {
        return array(
            'ajaxOnly +lastPeriodEnd'
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'report_id' => $id,
        ));

        $reports['position'] = ReportPosition::model()->grouped($id);
        $reports['banner'] = ReportBanner::model()->findAll($criteria);
        $reports['context'] = ReportContext::model()->findAll($criteria);
        $reports['custom'] = ReportCustom::model()->findAll($criteria);
        $reports['subscription'] = ReportSubscription::model()->findAll($criteria);

        $balance = $model->getBalanceInfo();

        $this->render('view', array(
            'model' => $model,
        ) + $reports + $balance);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Report;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Report'])) {
            $model->attributes = $_POST['Report'];
            if ($model->save()) {
                try {
                    Yii::app()->amqp->publish($model->id);
                    Yii::app()->user->setFlash('success', 'Добавлено в очередь на расчет');
                    $this->redirect(array('view', 'id' => $model->id));
                } catch (AMQPException $e) {
                    $model->deleteByPk($model->id);
                    Yii::app()->user->setFlash('error', 'Ошибка при добавлении в очередь (' . $e->getMessage() . ')');
                    $this->redirect(array('index'));
                }
            }
        }

        $this->render('create', array(
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
        $model = new Report('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Report']))
            $model->attributes = $_GET['Report'];

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
        $model = Report::model()->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'report-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLastPeriodEnd($clientId)
    {
        $model = Report::model()->findByAttributes(array('client_id' => $clientId), array(
            'order' => 'period_end DESC'
        ));
        if ($model) {
            print $model->period_end;
        } else {
            return false;
        }
    }
}

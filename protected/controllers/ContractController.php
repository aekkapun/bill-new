<?php

class ContractController extends Controller
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Sites
        $sites = SiteContract::model()->findAllByAttributes(array(
            'contract_id' => $id,
        ));

        $attachments = ContractAttachment::model()->findAllByAttributes(array(
            'contract_id' => $id,
        ));

        $acts = Act::model()->findAllByAttributes(array(
            'contract_id' => $id,
        ));

        $bills = Bill::model()->findAllByAttributes(array(
            'contract_id' => $id,
        ));

        $this->render('view', array(
            'model' => $model,
            'sites' => $sites,
            'attachments' => $attachments,
            'acts' => $acts,
            'bills' => $bills,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = Contract::model()->by('client_id', Yii::app()->user->client_id);

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
        $model = Contract::model()->by('client_id', Yii::app()->user->client_id)->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contract-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

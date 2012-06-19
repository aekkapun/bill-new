<?php

class DefaultController extends Controller
{
    public function init()
    {
        $am = Yii::app()->assetManager;
        $cs = Yii::app()->clientScript;

        $assets = Yii::getPathOfAlias('application.modules.admin.modules.import.assets.grid');
        $basepath = $am->publish($assets, false, -1, YII_DEBUG);
        $cs->registerCssFile($basepath . '/styles.css');
    }

    public function actionIndex($src = null)
    {
        $form = null;
        $model = null;

        if ($src !== null) {

            $adapterClassName = ucfirst($src) . 'Adapter';
            $model = Yii::createComponent($adapterClassName);

            $form = new CForm($model->form, $model);

            if ($form->submitted('preview') && $form->validate()) {

                $result = $model->process();

                if ($result['status'] === AdapterInterface::PROCESS_STATUS_OK) {

                    Yii::app()->session->add($adapterClassName . '_data', $result);

                    $this->redirect(array('/admin/import/default/preview', 'src' => $src));

                } else {
                    Yii::app()->user->setFlash('error', $result['errorMessage']);
                }
            }
        }

        $this->render('index', array(
            'form' => $form,
            'model' => $model
        ));
    }

    public function actionPreview($src)
    {
        $adapterClassName = ucfirst($src) . 'Adapter';
        $result = Yii::app()->session->get($adapterClassName . '_data');

        $dataProvider = new CArrayDataProvider($result['data']);

        $this->render($src . DIRECTORY_SEPARATOR . 'preview', array(
            'dataProvider' => $dataProvider,
            'src' => $src,
        ));
    }

    public function actionCommit($src)
    {
        $adapterClassName = ucfirst($src) . 'Adapter';
        $result = Yii::app()->session->get($adapterClassName . '_data');

        $model = Yii::createComponent($adapterClassName);

        $result = $model->commit($result);

        if ($result !== null) {
            $this->render($src . DIRECTORY_SEPARATOR . 'commit', $result);
        } else {
            $this->redirect(array('/admin/import'));
        }
    }
}
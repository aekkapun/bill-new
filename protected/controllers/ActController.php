<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/15/12
 * Time: 3:02 PM
 * To change this template use File | Settings | File Templates.
 */
class ActController extends Controller
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'client_id' => Yii::app()->user->client_id,
        ));


        $dataProvider = new CActiveDataProvider('Act', array(
            'criteria' => $criteria,
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));

    }
}

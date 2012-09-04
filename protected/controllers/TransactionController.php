<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/15/12
 * Time: 3:02 PM
 * To change this template use File | Settings | File Templates.
 */
class TransactionController extends Controller
{
    public function actionIndex()
    {
        $this->render('index', array(
            'dataProvider' => new CActiveDataProvider('Transaction'),
        ));
    }
}

<?php


class RbacCommand extends CConsoleCommand
{
    /*
     * run console command
     */
    public function run($args)
    {
        parent::run($args);
    }

    /*
     * update action
     */
    public function actionUpdate()
    {

        /**
         * 'client', 'manager', 'accountant', 'admin'
         */

        $db = Yii::app()->db;

        $command = $db->createCommand('TRUNCATE auth_assignment')->execute();
        $command = $db->createCommand('TRUNCATE auth_item_child')->execute();

        $auth = Yii::app()->authManager;



        $criteria = new CDbCriteria();
        $criteria->select = array('id', 'role');

        $users = User::model()->findAll($criteria);
        foreach ($users AS $user) {
            $auth->assign($user->role, $user->id);
        }

        $auth->save();
    }


}
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

        $command = $db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();
        $command = $db->createCommand('TRUNCATE auth_assignment');
        $command->execute();

        $command = $db->createCommand('TRUNCATE auth_item_child');
        $command->execute();

        $command = $db->createCommand('TRUNCATE auth_item');
        $command->execute();
        $command = $db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();

        $auth = Yii::app()->authManager;

        $task = $auth->createTask('manageUsers');

        // Права менеджера
        $role = $auth->createRole('manager');

        // Права админа
        $role = $auth->createRole('admin');
        $role->addChild('manager');
        $role->addChild('manageUsers');

        $auth->save();

        $criteria = new CDbCriteria();
        $criteria->select = array('id', 'role');

        $users = User::model()->findAll($criteria);
        foreach ($users AS $user) {
            $auth->assign($user->role, $user->id);
        }

        $auth->save();
    }


}
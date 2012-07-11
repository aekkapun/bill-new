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

        $transaction = $db->beginTransaction();

        try {

            $command = $db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();

            $command = $db->createCommand('TRUNCATE auth_assignment')->execute();
            $command = $db->createCommand('TRUNCATE auth_item_child')->execute();
            $command = $db->createCommand('TRUNCATE auth_item')->execute();

            $command = $db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();

            $auth = Yii::app()->authManager;


            $role = $auth->createRole('client');

            // Права менеджера
            $role = $auth->createRole('manager');

            // Права бухгалтера
            $role = $auth->createRole('accountant');

            // Права админа
            $role = $auth->createRole('admin');
            $role->addChild('manager');
            $role->addChild('accountant');

            $criteria = new CDbCriteria();
            $criteria->select = array('id', 'role', 'name');

            $users = User::model()->findAll($criteria);
            foreach ($users AS $user) {
                print "* Назначаем права доступа для " . $user->name . "\n";
                $auth->assign($user->role, $user->id);
            }

            if($auth->save()) {
                $transaction->commit();
            }

        } catch (CException $e) {
            print $e->getMessage();
            $transaction->rollback();
        }
    }


}
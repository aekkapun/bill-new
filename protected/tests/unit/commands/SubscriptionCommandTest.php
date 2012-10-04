<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 05.07.12
 * Time: 12:57
 * To change this template use File | Settings | File Templates.
 */
class SubscriptionCommandTest extends CDbTestCase
{

    public $fixtures = array(
        'Client',
        'Contract',
        'Site',
        'SubscriptionInput',
        'SiteService',
    );

    public function testCountIndocators()
    {
        $commandName = 'SubscriptionCommand';
        $CCRunner = new CConsoleCommandRunner();

        $shell = new SubscriptionCommand($commandName, $CCRunner);
        $shell->run(array('update'));

        $model = SubscriptionPeriod::model()->findByPk(1);
        $this->assertEquals($model->avg_link_price, 0.90);
    }

}

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 05.07.12
 * Time: 12:57
 * To change this template use File | Settings | File Templates.
 */
class BannerCommandTest extends CDbTestCase
{

    public $fixtures = array(
        'Client',
        'Contract',
        'Site',
        'BannerInput',
        'SiteService',
    );

    public function testCountIndocators()
    {
        $commandName = 'BannerCommand';
        $CCRunner = new CConsoleCommandRunner();

        $shell = new BannerCommand($commandName, $CCRunner);
        $shell->run(array('update'));

        $model = BannerPeriod::model()->findByPk(1);

        $this->assertEquals($model->avg_transition_price, 20);
    }

}

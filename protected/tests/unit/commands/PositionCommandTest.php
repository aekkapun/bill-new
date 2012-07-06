<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 05.07.12
 * Time: 12:57
 * To change this template use File | Settings | File Templates.
 */
class PositionCommandTest extends CDbTestCase
{

    public $fixtures = array(
        'Client',
        'Contract',
        'Site',
        'PositionInput',
        'SiteService',
    );

    public function testCountIndocators()
    {
        $commandName = 'PositionCommand';
        $CCRunner = new CConsoleCommandRunner();

        $shell = new PositionCommand($commandName, $CCRunner);
        $shell->run(array('update'));

        $model = PositionPeriod::model()->findByPk(1);
        $this->assertEquals(10, $model->sum);
        $model = PositionPeriod::model()->findByPk(2);
        $this->assertEquals(10, $model->sum);

    }
}

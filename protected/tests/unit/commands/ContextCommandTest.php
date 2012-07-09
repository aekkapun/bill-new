<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 05.07.12
 * Time: 12:57
 * To change this template use File | Settings | File Templates.
 */
class ContextCommandTest extends CDbTestCase
{

    public $fixtures = array(
        'Client',
        'Contract',
        'Site',
        'ContextInput',
        'SiteService',
    );

    public function testCountIndocators()
    {
        $commandName = 'ContextCommand';
        $CCRunner = new CConsoleCommandRunner();

        $shell = new ContextCommand($commandName, $CCRunner);
        $shell->run(array('update'));

        $model = ContextPeriod::model()->findByPk(1);
        $this->assertEquals(350, $model->transitions_sum);
        $this->assertEquals(12.5, $model->avg_transition_price_per_day);

        $model = ContextPeriod::model()->findByPk(2);
        $this->assertEquals(400, $model->transitions_sum);
        $this->assertEquals(1.38, $model->avg_transition_price_per_day);
    }

}

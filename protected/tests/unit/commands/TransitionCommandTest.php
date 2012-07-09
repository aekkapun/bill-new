<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 05.07.12
 * Time: 12:57
 * To change this template use File | Settings | File Templates.
 */
class TransitionCommandTest extends CDbTestCase
{

    public $fixtures = array(
        'Client',
        'Contract',
        'Site',
        'TransitionInput',
        'SiteService',
    );

    public function testCountIndocators()
    {
        $commandName = 'TransitionCommand';
        $CCRunner = new CConsoleCommandRunner();

        $shell = new TransitionCommand($commandName, $CCRunner);
        $shell->run(array('update'));

    }

}

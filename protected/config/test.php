<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),

    array(
        'import' => array(
            'application.commands.*',
        ),
        'components' => array(
            'fixture' => array(
                'class' => 'system.test.CDbFixtureManager',
            ),
            'db' => array(
                'connectionString' => 'mysql:dbname=inmar_test;host=127.0.0.1',
                'username' => 'root',
                'password' => '',
                'charset' => 'UTF8',
            ),
        ),
    )
);

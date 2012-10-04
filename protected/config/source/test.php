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
                'connectionString' => '[[database.type]]:host=[[database.host]];dbname=[[database.basename]]',
                'username' => '[[database.username]]',
                'password' => '[[database.password]]',
                'charset' => '[[database.charset]]',
                'emulatePrepare' => '[[database.emulatePrepare]]',
                'tablePrefix' => '[[database.tablePrefix]]',
                'schemaCachingDuration' => '[[database.schemaCachingDuration]]',
                'queryCachingDuration' => '[[database.queryCachingDuration]]',
                'enableParamLogging' => '[[database.enableParamLogging]]',
                'enableProfiling' => '[[database.enableProfiling]]',
            ),
        ),
    )
);

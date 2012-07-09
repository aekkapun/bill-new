<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',

    'language' => 'ru',

    'timeZone' => 'Europe/Moscow',

    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
    ),

    'commandMap' => array(
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'templateFile' => 'application.migrations.template',
        ),
    ),

    // application components
    'components' => array(
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
        ),
        'db' => array(
            'class' => 'application.components.DbConnectionDev',
        ),
    ),
);
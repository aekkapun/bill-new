<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Биллинг',

    'preload' => array('log'),

    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',

    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
    ),

    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'qqq',
            'ipFilters' => array('127.0.0.1'),
        ),
        'admin' => array(
            'password' => 'qqq',
            'ipFilters' => array('*'),
        ),
    ),

    // application components
    'components' => array(
        'amqp' => array(
            'class' => 'ext.amqplib.Amqp',
        ),
        'format' => array(
            'booleanFormat' => array('Нет', 'Да'),
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            'driver' => 'GD',
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'securityManager' => array(
            'class' => 'SecurityManager',
            'hashAlgorithm' => 'md5',
            'validationKey' => md5('da0095b3833bfe649d4683213b086q76'),
        ),
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'itemTable' => 'auth_item',
            'itemChildTable' => 'auth_item_child',
            'assignmentTable' => 'auth_assignment',
        ),
        'user' => array(
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/session/create'),
        ),
        'urlManager' => array(
//            'class' => 'UrlManager',
//            'urlSuffix' => '.html',
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(

                'login' => 'session/create',
                'logout' => 'session/delete',

                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=127.0.0.1;dbname=inmar',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'emulatePrepare' => 'true',
            'tablePrefix' => '',
        ),
        'errorHandler' => array(
            'errorAction' => 'error/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'DbLogRoute',
                    'connectionID' => 'db',
                    'logTableName' => 'admin_log',
                    'levels' => 'user',
                ),
            ),
        ),
    ),

    'params' => array(
		'emptySelectLabel' => '-- выбрать --',
    ),
);
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
        'admin',
        'subscription',
    ),

    // application components
    'components' => array(
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
            'class' => 'CDbAuthManager'
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
        /*'clientScript' => array(
            'class' => 'CClientScript',
            'corePackages' => array(
                'jquery' => array(
                    'baseUrl' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/', //unset the defaults
                    'js' => array('jquery.min.js'),
                ),
            ),
        ),*/
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
    ),
);
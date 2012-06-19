<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 9/23/11
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

return CMap::mergeArray(
    require_once(__DIR__ . '/main.php'),
    array(
        'modules' => array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password' => 'qqq',
                'ipFilters' => array('*'),
            ),
            'admin' => array(
                'password' => 'qqq',
                'ipFilters' => array('127.0.0.1'),
            ),
        ),
        'components' => array(
            'cache' => array(
                'class' => 'CDummyCache',
            ),
            'db' => array(
                'class' => YII_DEBUG ? 'DbConnectionDev' : 'DbConnection',
            ),
            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning',
                    ),
                    /*array(
                        'class' => 'CWebLogRoute',
                    ),*/
                ),
            ),
        ),

        'params' => array(
            'adminEmail' => 'denis.a.boldinov@gmail.com',
            'uploadDir' => Yii::getPathOfAlias('webroot') . DIRECTORY_SEPARATOR . 'upload',
        ),
    )
);
 

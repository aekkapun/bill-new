<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 10/26/11
 * Time: 1:39 PM
 * To change this template use File | Settings | File Templates.
 */

class Parser1C extends CComponent
{
    private static $_parser;
    
    private function __construct()
    {
        ;
    }

    /**
     * @static
     * @param $version
     * @return 
     */
    public static function factory($version)
    {
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . 'Parser1C' . DIRECTORY_SEPARATOR . $version . '.php';
        require_once($fileName);

        $className = 'Parser1C_' . $version;

        assert(class_exists($className));

        self::$_parser = new $className;
        return self::$_parser;
    }
}

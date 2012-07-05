<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denisboldinov
 * Date: 5/14/12
 * Time: 2:36 PM
 * To change this template use File | Settings | File Templates.
 */
class Time
{
    public static function ts2dt($ts)
    {
        return date('Y-m-d H:i:s', $ts);
    }

    public static function dt2ts($dt)
    {
        return strtotime($dt);
    }
}

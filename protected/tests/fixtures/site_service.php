<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 05.07.12
 * Time: 14:18
 * To change this template use File | Settings | File Templates.
 */

return array(
    'subscription' => array(
        'site_id' => 1,
        'service_id' => Service::SUBSCRIPTION,
        'contract_id' => 1,
        'enabled' => 1,
        'params' => CJSON::encode(array('sum' => 1000)),
    ),
    'banner' => array(
        'site_id' => 1,
        'service_id' => Service::BANNERS,
        'contract_id' => 1,
        'enabled' => 1,
        'params' => CJSON::encode(array('budget' => 1000)),
    ),
);
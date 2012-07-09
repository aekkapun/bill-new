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
    'position' => array(
        'site_id' => 1,
        'service_id' => Service::POSITION,
        'contract_id' => 1,
        'enabled' => 1,
        'params' => '{"phrases":{"1":{"id":"1","site_id":"1","phrase":"test","hash":"098f6bcd4621d373cade4e832627b4f6","price":"1.00","active":"1","created_at":"2012-07-05 09:10:51","updated_at":"2012-07-05 09:10:51"},"2":{"id":"2","site_id":"1","phrase":"test2","hash":"ad0234829205b9033196ba818f7a872b","price":"2.00","active":"1","created_at":"2012-07-05 09:10:57","updated_at":"2012-07-05 09:10:57"}},"factors":{"1":{"id":"1","name":"Google TOP3","system_id":"1","position":"3","value":"1.00","created_at":"2012-07-05 08:51:04","updated_at":"0000-00-00 00:00:00"},"2":{"id":"2","name":"Google TOP5","system_id":"1","position":"5","value":"2.00","created_at":"2012-07-05 08:51:04","updated_at":"0000-00-00 00:00:00"},"3":{"id":"3","name":"Google TOP10","system_id":"1","position":"10","value":"3.00","created_at":"2012-07-05 08:51:04","updated_at":"0000-00-00 00:00:00"},"4":{"id":"4","name":"Yandex TOP3","system_id":"2","position":"3","value":"4.00","created_at":"2012-07-05 08:51:04","updated_at":"0000-00-00 00:00:00"},"5":{"id":"5","name":"Yandex TOP5","system_id":"2","position":"5","value":"5.00","created_at":"2012-07-05 08:51:04","updated_at":"0000-00-00 00:00:00"},"6":{"id":"6","name":"Yandex TOP10","system_id":"2","position":"10","value":"6.00","created_at":"2012-07-05 08:51:04","updated_at":"0000-00-00 00:00:00"}}}'
    ),
    'context' => array(
        'site_id' => 1,
        'service_id' => Service::CONTEXT,
        'contract_id' => 1,
        'enabled' => 1,
        'params' => '{"advPlatforms":{"1":{"id":"1","name":"Google","created_at":"2012-07-05 09:13:04","updated_at":"2012-07-05 09:13:04","budget":"10000.00","work_percent":"0.10"},"2":{"id":"2","name":"Yandex","created_at":"2012-07-09 14:42:57","updated_at":"2012-07-09 14:42:57","budget":"20000.00","work_percent":"0.30"}}}'
    ),
);
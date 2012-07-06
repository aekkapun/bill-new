<?php
/**
 * Created by JetBrains PhpStorm.
 * User: denis
 * Date: 06.07.12
 * Time: 10:20
 * To change this template use File | Settings | File Templates.
 */
class PositionInputTest extends CDbTestCase
{
    public $fixtures = array(
        'clients' => 'Client',
        'contracts' => 'Contract',
        'sites' => 'Site',
        'positions' => 'PositionInput',
        'siteServices' => 'SiteService',
    );

    public function testCreate()
    {
        $params = CJSON::decode($this->siteServices['position']['params']);

        $attributes = array(
            'phrase' => 'test',
            'hash' => md5('test'),
            'position' => 1,
            'system_id' => Factor::SYSTEM_YANDEX,
            'site_id' => $this->sites['site1']['id'],
            'contract_id' => $this->contracts['contract1']['id'],
            'factors' => $params['factors'],
            'created_at' => date('Y-m-d H:i:s'),
        );
        if (($searchPhrase = Common::searchArray($params['phrases'], 'hash', md5('test'))) !== false) {
            $attributes['phraseMeta'] = $searchPhrase[0];
        }

        // Assert that phrase with position 4 in Yandex is in TOP5 with price 4
        $model = new PositionInput();
        $model->attributes = $attributes;
        $model->save();

        $this->assertEquals(count($model->getErrors()), 0);

        $this->assertEquals($model->factor, 4);
        $this->assertEquals($model->price, 4);

        $model = new PositionInput();
        $attributes['position'] = 5;
        $model->attributes = $attributes;
        $model->save();

        $this->assertEquals(count($model->getErrors()), 0);

        $this->assertEquals($model->factor, 5);
        $this->assertEquals($model->price, 5);

        $model = new PositionInput();
        $attributes['position'] = 10;
        $model->attributes = $attributes;
        $model->save();

        $this->assertEquals(count($model->getErrors()), 0);

        $this->assertEquals($model->factor, 6);
        $this->assertEquals($model->price, 6);

        $model = new PositionInput();
        $attributes['position'] = 12;
        $model->attributes = $attributes;
        $model->save();

        $this->assertEquals(count($model->getErrors()), 0);

        $this->assertEquals($model->factor, 0);
        $this->assertEquals($model->price, 0);
    }
}

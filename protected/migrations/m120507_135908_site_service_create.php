<?php

class m120507_135908_site_service_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

        $this->createTable('service', array(
            'name' => 'string NOT NULL',
        ));

        $this->createTable('site_service', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'service_id' => self::MYSQL_TYPE_UINT,
            'params' => 'text',
            'options' => 'text',
        ));

        $services = array(
            array(
                'id' => 1,
                'name' => 'Абоненская плата',
            ),
            array(
                'id' => 2,
                'name' => 'По позициям',
            ),
            array(
                'id' => 3,
                'name' => 'По переходам',
            ),
            array(
                'id' => 4,
                'name' => 'Контекстная реклама',
            ),
            array(
                'id' => 5,
                'name' => 'Баннерная реклама',
            ),
        );

        $this->truncateTable('service');
        foreach($services as $service) {
            $this->insert('service', $service);
        }
    }

    public function safeDown()
    {
        $this->dropTable('service');
        $this->dropTable('site_service');
    }
}
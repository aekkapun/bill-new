<?php

class m120411_123031_site_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('site', array(
            'client_id' => self::MYSQL_TYPE_UINT,
            'domain' => 'string NOT NULL'
        ));

        $this->addForeignKey('site_client_id', 'site', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('site_contract', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'contract_id' => self::MYSQL_TYPE_UINT,
        ));

        $this->addForeignKey('site_contract_site_id', 'site_contract', 'site_id', 'site', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('site_contract_contract_id', 'site_contract', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('site_client_id', 'site');
        $this->dropForeignKey('site_contract_site_id', 'site_contract');
        $this->dropForeignKey('site_contract_contract_id', 'site_contract');

        $this->dropTable('site');
        $this->dropTable('site_contract');
    }
}
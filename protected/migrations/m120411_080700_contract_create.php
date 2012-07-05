<?php

class m120411_080700_contract_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('contract', array(
            'number' => 'string NOT NULL',
            'client_id' => self::MYSQL_TYPE_UINT,
            'status' => 'tinyint(1) NOT NULL DEFAULT 1',
        ));

        $this->addForeignKey('contract_client_id', 'contract', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('contract_client_id', 'contract');
        $this->dropTable('contract');
    }
}
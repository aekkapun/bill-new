<?php

class m120411_110323_contract_attachment_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('contract_attachment', array(
            'contract_id' => self::MYSQL_TYPE_UINT,
            'file' => 'string NOT NULL',
        ));

        $this->addForeignKey('contract_attachment_contract_id', 'contract_attachment', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('contract_attachment_contract_id', 'contract_attachment');

        $this->dropTable('contract_attachment');
    }
}
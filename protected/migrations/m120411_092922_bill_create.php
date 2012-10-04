<?php

class m120411_092922_bill_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        // Счет
        $this->createTable('bill', array(
            'client_id' => self::MYSQL_TYPE_UINT,
            'contract_id' => self::MYSQL_TYPE_UINT,
            'number' => 'string NOT NULL',
            'sum' => 'decimal(20,2) NOT NULL DEFAULT 0',
            'file' => 'string',
            'period' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
        ));

        $this->addForeignKey('bill_contract_id', 'bill', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('bill_client_id', 'bill', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');

        // Счет-фактура
        $this->createTable('invoice', array(
            'number' => 'string NOT NULL',
            'client_id' => self::MYSQL_TYPE_UINT,
            'contract_id' => self::MYSQL_TYPE_UINT,
            'period' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
        ));

        $this->addForeignKey('invoice_contract_id', 'invoice', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('invoice_client_id', 'invoice', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');

        // Платеж
        $this->createTable('payment', array(
            'client_id' => self::MYSQL_TYPE_UINT,
            'contract_id' => self::MYSQL_TYPE_UINT,
            'details' => 'text',
            'sum' => 'decimal(20,2) NOT NULL DEFAULT 0',
            'period' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
        ));

        $this->addForeignKey('payment_contract_id', 'payment', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('payment_client_id', 'payment', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');

        // Акт
        $this->createTable('act', array(
            'client_id' => self::MYSQL_TYPE_UINT,
            'contract_id' => self::MYSQL_TYPE_UINT,
            'number' => 'string NOT NULL',
            'sum' => 'decimal(20,2) NOT NULL DEFAULT 0',
            'period' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'file' => 'string',
            'signed' => 'tinyint(1) NOT NULL DEFAULT 0'
        ));

        $this->addForeignKey('act_contract_id', 'act', 'contract_id', 'contract', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('act_client_id', 'act', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('act_contract_id', 'act');
        $this->dropForeignKey('act_client_id', 'act');

        $this->dropForeignKey('payment_client_id', 'payment');
        $this->dropForeignKey('payment_contract_id', 'payment');

        $this->dropForeignKey('invoice_contract_id', 'invoice');
        $this->dropForeignKey('invoice_client_id', 'invoice');

        $this->dropForeignKey('bill_contract_id', 'bill');
        $this->dropForeignKey('bill_client_id', 'bill');

        $this->dropTable('act');
        $this->dropTable('payment');
        $this->dropTable('bill');
        $this->dropTable('invoice');

    }
}
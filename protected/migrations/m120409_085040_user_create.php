<?php

class m120409_085040_user_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('user', array(
            'name' => 'string NOT NULL',
            'role' => "ENUM('client', 'manager', 'accountant', 'admin') NOT NULL",
            'email' => 'string NOT NULL',
            'password' => 'varchar(32) NOT NULL',
            'hash' => 'varchar(32) NOT NULL',
        ));

        $this->createTable('client', array(
            'manager_id' => self::MYSQL_TYPE_UINT,
            'name' => 'string NOT NULL',
            'address' => 'string',
            'is_corporate' => 'tinyint(1) NOT NULL DEFAULT 0',
            'post_code' => 'string',
            'code_1c' => 'string',
            'phone' => 'string',
            'status' => 'tinyint(1)',
        ));

        $this->createTable('client_user', array(
            'client_id' => self::MYSQL_TYPE_UINT,
            'user_id' => self::MYSQL_TYPE_UINT,
        ));

        // FK
        $this->addForeignKey('client_manager_id', 'client', 'manager_id', 'user', 'id', 'CASCADE', 'RESTRICT');

        $this->addForeignKey('client_user_client_id', 'client_user', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('client_user_user_id', 'client_user', 'user_id', 'user', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('client_user_id', 'client');
        $this->dropForeignKey('client_manager_id', 'client');

        $this->dropForeignKey('user_agent_user_id', 'user_agent');
        $this->dropForeignKey('user_agent_agent_id', 'user_agent');

        $this->dropTable('user');
        $this->dropTable('client');
        $this->dropTable('user_agent');
    }
}
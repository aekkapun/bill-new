<?php

class m120507_160213_position_input extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('position_input', array(
            'phrase' => 'text NOT NULL',
            'hash' => 'string NOT NULL',
            'position' => self::MYSQL_TYPE_UINT,
            'system_id' => 'tinyint(4) NOT NULL',
            'site_id' => self::MYSQL_TYPE_UINT,
        ));
    }

    public function safeDown()
    {
        $this->dropTable('position_input');
    }
}
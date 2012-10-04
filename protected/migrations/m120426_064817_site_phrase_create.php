<?php

class m120426_064817_site_phrase_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('site_phrase', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'phrase' => 'string NOT NULL',
            'hash' => 'varchar(32)',
            'price' => 'decimal(10,2) NOT NULL',
            'active' => self::MYSQL_TYPE_BOOLEAN,
        ));

        $this->addForeignKey('site_phrase_site_id', 'site_phrase', 'site_id', 'site', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('site_phrase_site_id', 'site_phrase');
        $this->dropTable('site_phrase');
    }
}
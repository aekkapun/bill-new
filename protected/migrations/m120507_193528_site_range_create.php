<?php

class m120507_193528_site_range_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('site_range', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'valueMin' => self::MYSQL_TYPE_UINT,
            'valueMax' => self::MYSQL_TYPE_UINT,
            'price' => self::MYSQL_TYPE_UINT,
        ));
        $this->addForeignKey('site_range_site_id', 'site_range', 'site_id', 'site', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('site_range_site_id', 'site_range');
        $this->dropTable('site_range');
    }
}
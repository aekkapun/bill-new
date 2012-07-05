<?php
class m120703_053825_banner_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('banner_input', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'transitions' => self::MYSQL_TYPE_UINT,
            'sum' => self::MYSQL_TYPE_UINT,
            'params' => 'text',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('banner_input');
    }
}
<?php
class m120523_075503_alter_site_range extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->alterColumn('site_range', 'price', self::MYSQL_TYPE_MONEY);
    }

    public function safeDown()
    {
        return;
    }
}
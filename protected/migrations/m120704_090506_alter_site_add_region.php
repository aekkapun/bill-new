<?php
class m120704_090506_alter_site_add_region extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('site', 'region', 'string');
    }

    public function safeDown()
    {
        $this->dropColumn('site', 'region');
    }
}
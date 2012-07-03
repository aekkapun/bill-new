<?php
class m120703_060052_site_service_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('site_service', 'enabled', 'tinyint DEFAULT 1');
        $this->addColumn('site_service', 'terminated_at', 'TIMESTAMP NULL DEFAULT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('site_service', 'enabled');
        $this->dropColumn('site_service', 'terminated_at');
    }
}
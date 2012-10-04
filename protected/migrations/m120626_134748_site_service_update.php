<?php
class m120626_134748_site_service_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('site_service', 'contract_id', self::MYSQL_TYPE_UINT);
    }

    public function safeDown()
    {
        $this->dropColumn('site_service', 'contract_id');
    }
}
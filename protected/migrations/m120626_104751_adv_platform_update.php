<?php
class m120626_104751_adv_platform_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('adv_platform', 'budget', self::MYSQL_TYPE_MONEY);
        $this->addColumn('adv_platform', 'work_percent', self::MYSQL_TYPE_MONEY);
    }

    public function safeDown()
    {
        $this->dropColumn('adv_platform', 'budget');
        $this->dropColumn('adv_platform', 'work_percent');
    }
}
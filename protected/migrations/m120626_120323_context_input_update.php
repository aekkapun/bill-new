<?php
class m120626_120323_context_input_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('context_input', 'adv_platform_id', self::MYSQL_TYPE_UINT);
    }

    public function safeDown()
    {
        $this->dropColumn('context_input', 'adv_platform_id');
    }
}
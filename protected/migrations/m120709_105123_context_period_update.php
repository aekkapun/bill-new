<?php
class m120709_105123_context_period_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('context_period', 'adv_platform_id', self::MYSQL_TYPE_UINT);
        $this->addColumn('context_period', 'avg_transition_price_per_day', self::MYSQL_TYPE_MONEY);
    }

    public function safeDown()
    {
        $this->dropColumn('context_period', 'adv_platform_id');
        $this->dropColumn('context_period', 'avg_transition_price_per_day');
    }
}
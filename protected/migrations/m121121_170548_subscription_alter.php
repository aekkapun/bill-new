<?php
class m121121_170548_subscription_alter extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('report_subscription', 'transitions_count', 'integer');
        $this->addColumn('report_subscription', 'avg_transition_price', self::MYSQL_TYPE_MONEY);
    }

    public function safeDown()
    {
        $this->dropColumn('report_subscription', 'transitions_count');
        $this->dropColumn('report_subscription', 'avg_transition_price');
    }
}
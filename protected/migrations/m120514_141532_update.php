<?php
class m120514_141532_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->alterColumn('context_input', 'transitions_sum', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('context_input', 'avg_transition_price', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('context_period', 'transitions_sum', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('factor', 'value', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('position_period', 'sum', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('site_phrase', 'price', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('subscription_period', 'avg_link_price', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('transition_period', 'transition_sum', self::MYSQL_TYPE_MONEY);
        $this->alterColumn('transition_period', 'transition_sum', self::MYSQL_TYPE_MONEY);
    }

    public function safeDown()
    {
        ;
    }
}
<?php
class m121017_195425_add_transitions_count_field_to_subscription_input_table extends DbMigration
{
    public function safeUp()
    {
        $this->addColumn('subscription_input', 'transitions_count', self::MYSQL_TYPE_UINT);
    }

    public function safeDown()
    {
        $this->dropColumn('subscription_input', 'transitions_count');
    }
}
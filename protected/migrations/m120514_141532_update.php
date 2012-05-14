<?php
class m120514_141532_update extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->update('context_input', array(
            'transitions_sum' => self::MYSQL_TYPE_MONEY,
            'avg_transition_price' => self::MYSQL_TYPE_MONEY,
        ));

        $this->update('context_period', array(
            'transitions_sum' => self::MYSQL_TYPE_MONEY,
        ));

        $this->update('factor', array(
            'value' => self::MYSQL_TYPE_MONEY,
        ));
    }

    public function safeDown()
    {
        ;
    }
}
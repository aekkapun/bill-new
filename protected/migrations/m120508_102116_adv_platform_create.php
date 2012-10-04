<?php
class m120508_102116_adv_platform_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('adv_platform', array(
            'name' => 'string NOT NULL',
        ));

        $this->createTable('context_input', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'transitions_count' => self::MYSQL_TYPE_UINT,
            'transitions_sum' => 'decimal(5,2) NOT NULL',
            'avg_transition_price' => 'decimal(5,2) NOT NULL',
        ));
    }

    public function safeDown()
    {
        $this->dropTable('adv_platform');
        $this->dropTable('context_input');
    }
}
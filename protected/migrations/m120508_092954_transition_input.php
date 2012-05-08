<?php

class m120508_092954_transition_input extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('transition_input', array(
            'site_id' => self::MYSQL_TYPE_UINT,
            'transitions' => self::MYSQL_TYPE_UINT,
        ));
    }

    public function safeDown()
    {
        $this->dropTable('transition_input');
    }
}
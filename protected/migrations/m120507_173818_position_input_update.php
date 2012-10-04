<?php

class m120507_173818_position_input_update extends DbMigration
{

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->addColumn('position_input', 'price', 'decimal(10,2)');
        $this->addColumn('position_input', 'factor', self::MYSQL_TYPE_UINT);
    }

    public function safeDown()
    {
        $this->dropColumn('position_input', 'price');
        $this->dropColumn('position_input', 'factor');
    }
}
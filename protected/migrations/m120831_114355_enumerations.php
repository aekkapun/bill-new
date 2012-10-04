<?php
class m120831_114355_enumerations extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('enumeration', array(
            'name' => 'string NOT NULL',
        ));

        $this->createTable('enumeration_item', array(
            'enumeration_id' => self::MYSQL_TYPE_UINT,
            'name' => 'string NOT NULL',
            'value' => 'string NOT NULL',
            'is_default' => self::MYSQL_TYPE_BOOLEAN,
            'active' => self::MYSQL_TYPE_BOOLEAN,
            'order' => self::MYSQL_TYPE_UINT,
        ));

        $this->addForeignKey('enumeration_item_enumeration_id', 'enumeration_item', 'enumeration_id', 'enumeration', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('enumeration_item_enumeration_id', 'enumeration_item');
        $this->dropTable('enumeration_item');
        $this->dropTable('enumeration');
    }
}
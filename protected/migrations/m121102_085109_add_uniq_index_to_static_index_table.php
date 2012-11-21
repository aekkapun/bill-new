<?php
class m121102_085109_add_uniq_index_to_static_index_table extends DbMigration
{
    public function safeUp()
    {
        $this->createIndex('name_unique_index', 'static_index', 'name', true);


    }


    public function safeDown()
    {
        $this->dropIndex('name_unique_index', 'static_index');
    }
}
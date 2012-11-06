<?php
class m121106_080751_add_site_range_name extends DbMigration
{
    protected $options = 'ENGINE=InnoDB CHARSET=utf8';

    public function safeUp()
    {
        // Create table
        $this->createTable('range_name', array(
            'name' => 'varchar(255) not null'
        ));

        $this->insert('range_name', array(
            'id' => 1,
            'name' => 'по-умолчанию',
        ));


        // Add column
        $this->addColumn('site_range', 'name_id', 'int(10) unsigned not null default 1');


        // Add foreign key
        $this->addForeignKey('site_range_range_name_name_id', 'site_range', 'name_id', 'range_name', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        // Drop foreign key
        $this->dropForeignKey('site_range_range_name_name_id', 'site_range');


        // Drop column
        $this->dropColumn('site_range', 'name_id');


        // Drop table
        $this->dropTable('range_name');
    }
}
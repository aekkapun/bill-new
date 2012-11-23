<?php
class m121123_092717_delete_default_site_range_name extends DbMigration
{
    public function safeUp()
    {
        $this->delete('site_range_name', 'id=1');

        $this->alterColumn('site_range', 'site_range_name_id', 'int(10) unsigned');
    }

    public function safeDown()
    {
        $this->insert('site_range_name', array(
            'id' => 1,
            'name' => 'по-умолчанию',
            'site_id' => $this->getExistId('site'),
            'contract_id' => $this->getExistId('contract'),
        ));

        $this->alterColumn('site_range', 'site_range_name_id', 'int(10) unsigned not null default 1');
    }
}
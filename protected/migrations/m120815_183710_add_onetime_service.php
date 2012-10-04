<?php
class m120815_183710_add_onetime_service extends DbMigration
{
    private $_onetimeService = array(
        'id' => 6,
        'name' => 'Разовая услуга',
    );

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->insert('service', $this->_onetimeService);
    }

    public function safeDown()
    {
        $condition = 'id = ' . $this->_onetimeService['id'];
        $this->delete('service', $condition);
    }
}
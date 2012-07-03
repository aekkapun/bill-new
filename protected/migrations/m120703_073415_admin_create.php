<?php
class m120703_073415_admin_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->insert('user', array(
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@ya.ru',
            'password' => '6890b9f88a67b80ebc7ecc3de63ea365',
            'hash' => '26564c0afb028bf46412357dd1ed04cb',
        ));
    }

    public function safeDown()
    {
        ;
    }
}
<?php

class m120410_134142_user_update extends DbMigration
{
    public function up()
    {
        $this->addColumn('user', 'client_id', 'INT UNSIGNED');
        $this->addForeignKey('user_client_id', 'user', 'client_id', 'client', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        echo "m120410_134142_user_update does not support migration down.\n";
        return false;
    }

    /*
     // Use safeUp/safeDown to do migration with transaction
     public function safeUp()
     {
     }

     public function safeDown()
     {
     }
     */
}
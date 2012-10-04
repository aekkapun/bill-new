<?php

class m120507_133704_factor_create extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('factor', array(
            'name' => 'string NOT NULL',
            'system_id' => self::MYSQL_TYPE_UINT,
            'position' => self::MYSQL_TYPE_UINT,
            'value' => 'DECIMAL(5,2) NOT NULL',
        ));

        $factors = array(
            array(
                'name' => 'Google TOP3',
                'system_id' => 1,
                'position' => 3,
                'value' => 1,
            ),
            array(
                'name' => 'Google TOP5',
                'system_id' => 1,
                'position' => 5,
                'value' => 2,
            ),
            array(
                'name' => 'Google TOP10',
                'system_id' => 1,
                'position' => 10,
                'value' => 3,
            ),
            array(
                'name' => 'Yandex TOP3',
                'system_id' => 2,
                'position' => 3,
                'value' => 4,
            ),
            array(
                'name' => 'Yandex TOP5',
                'system_id' => 2,
                'position' => 5,
                'value' => 5,
            ),
            array(
                'name' => 'Yandex TOP10',
                'system_id' => 2,
                'position' => 10,
                'value' => 6,
            ),
        );

        foreach ($factors as $factor) {
            $this->insert('factor', $factor);
        }

    }

    public function safeDown()
    {
        $this->dropTable('factor');
    }
}
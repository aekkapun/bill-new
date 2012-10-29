<?php
class m121029_195654_create_static_index extends DbMigration
{
    public function safeUp()
    {
        $this->createTable('static_index', array(
            'name' => 'varchar(255) not null',
            'title' => 'varchar(255) not null',
        ));

        $this->insert('static_index', array('name' => 'tic', 'title' => 'ТИЦ'));
        $this->insert('static_index', array('name' => 'pr', 'title' => 'PR'));
        $this->insert('static_index', array('name' => 'pages_in_yandex', 'title' => 'Страниц в Yandex'));
        $this->insert('static_index', array('name' => 'pages_in_google', 'title' => 'Страниц в Google'));
        $this->insert('static_index', array('name' => 'total_view_counts', 'title' => 'Суммарное количество просмотров'));
        $this->insert('static_index', array('name' => 'avg_uniq_users_count_per_month', 'title' => 'Среднесуточное количество уникальных пользователей в месяц'));
        $this->insert('static_index', array('name' => 'avg_view_depth', 'title' => 'Средняя глубина просмотра'));

        $this->createTable('static_index_input', array(
            'site_id' => 'int(10) unsigned not null',
            'static_index_id' => 'int(10) unsigned not null',
            'value' => 'int(10) not null',
            'input_date' => 'datetime not null',
        ));

        $this->addForeignKey('static_index_input_site_id', 'static_index_input', 'site_id', 'site', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('static_index_input_static_index_id', 'static_index_input', 'static_index_id', 'static_index', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('static_index_input_site_id', 'static_index_input');
        $this->dropForeignKey('static_index_input_static_index_id', 'static_index_input');

        $this->dropTable('static_index');
        $this->dropTable('static_index_input');
    }
}
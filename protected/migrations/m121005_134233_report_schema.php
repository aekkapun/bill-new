<?php
class m121005_134233_report_schema extends DbMigration
{
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->createTable('report_subscription', array(
            'report_id' => 'integer',
            'site_id' => 'integer',
            'sum' => self::MYSQL_TYPE_MONEY,
            'link_count' => 'integer',
            'avg_link_price' => self::MYSQL_TYPE_MONEY,
        ));

        $this->createTable('report_position', array(
            'report_id' => 'integer',
            'site_id' => 'integer',
            'system_id' => 'integer',
            'sum' => self::MYSQL_TYPE_MONEY,
        ));

        $this->createTable('report_banner', array(
            'report_id' => 'integer',
            'site_id' => 'integer',
            'transition_sum' => self::MYSQL_TYPE_MONEY,
            'sum' => self::MYSQL_TYPE_MONEY,
            'per_click' => 'integer',
        ));

        $this->createTable('report_context', array(
            'report_id' => 'integer',
            'site_id' => 'integer',
            'platform_id' => 'integer',
            'budget' => self::MYSQL_TYPE_MONEY,
            'transition_sum' => self::MYSQL_TYPE_MONEY,
            'avg_transition_price' => self::MYSQL_TYPE_MONEY,
        ));

        $this->createTable('report_custom', array(
            'report_id' => 'integer',
            'site_id' => 'integer',
            'name' => 'string',
            'price' => self::MYSQL_TYPE_MONEY,
        ));
    }

    public function safeDown()
    {
        $this->dropTable('report_subscription');
        $this->dropTable('report_position');
        $this->dropTable('report_banner');
        $this->dropTable('report_context');
        $this->dropTable('report_custom');
    }
}
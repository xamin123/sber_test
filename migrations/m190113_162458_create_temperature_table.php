<?php

use yii\db\Migration;

/**
 * Handles the creation of table `temperature`.
 */
class m190113_162458_create_temperature_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            'temperature',
            [
                'temperature_id' => $this->primaryKey(),
                'city_id' => $this->integer()->notNull(),
                'date' => $this->date()->notNull(),
                'temperature' => $this->decimal(10, 2)->notNull(),
            ]
        );

        $this->addForeignKey(
            'temperature_city_city_id_fk',
            'temperature',
            'city_id',
            'city',
            'city_id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex(
            'temperature_city_id_date_uindex',
            'temperature',
            ['city_id', 'date'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('temperature');
    }
}

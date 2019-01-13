<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m190113_161947_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'city_id' => $this->primaryKey(),
            'name_en' => $this->string()->notNull()->unique(),
            'name_ru' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }
}

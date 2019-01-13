<?php

use yii\db\Migration;

/**
 * Class m190113_163737_add_cities
 */
class m190113_163737_add_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert(
            'city',
            ['name_en', 'name_ru'],
            [
                ['Moscow', 'Москва'],
                ['Saratov', 'Саратов'],
                ['Astrakhan', 'Астрахань'],
            ]

        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190113_163737_add_cities cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190113_163737_add_cities cannot be reverted.\n";

        return false;
    }
    */
}

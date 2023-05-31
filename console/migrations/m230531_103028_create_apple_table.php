<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m230531_103028_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(255)->comment('цвет'),
            'eat_percent' => $this->smallInteger()->defaultValue(0)->comment('сколько съели'),
            'status' => $this->smallInteger()->notNull()->comment('статус'),
            'size' => $this->float(),
            'fall_date' => $this->timestamp()->comment('дата падения'),
            'created_at' => $this->timestamp()->comment('дата появления'),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}

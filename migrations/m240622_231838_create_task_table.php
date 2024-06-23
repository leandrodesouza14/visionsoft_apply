<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m240622_231838_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->string(510),
            'status_id' => $this->integer(),
            'created_at' => $this->date(),
            'conclusion_at' => $this->date(),
        ]);

        $this->addForeignKey('fk_task_status', 'task', 'status_id', 'status', 'id', null, 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_status', 'task');
        
        $this->dropTable('{{%task}}');
    }
}
<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%plot}}`.
 */
class m231021_125938_create_plot_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%plot}}', [
            'id' => $this->primaryKey(),
            'cadastralNumber' => $this->string(),
            'address' => $this->string(),
            'price' => $this->float(),
            'area' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%plot}}');
    }
}

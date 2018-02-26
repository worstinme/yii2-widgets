<?php

use yii\db\Migration;

/**
 * Class m180224_035907_slider_items
 */
class m180224_035907_widget_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widgets_items}}', [
            'id' => $this->primaryKey(),
            'widget_id' => $this->integer()->unsigned()->notNull(),
            'params'=> $this->text(),
            'sort'=>$this->integer()->unsigned(),
            'state'=>$this->boolean()->defaultValue(1),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180224_035907_slider_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180224_035907_slider_items cannot be reverted.\n";

        return false;
    }
    */
}

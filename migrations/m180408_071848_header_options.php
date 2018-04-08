<?php

use yii\db\Migration;

/**
 * Class m180408_071848_header_options
 */
class m180408_071848_header_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%widgets}}', 'header_class', $this->string());
        $this->addColumn('{{%widgets}}', 'header_show', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180408_071848_header_options cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180408_071848_header_options cannot be reverted.\n";

        return false;
    }
    */
}

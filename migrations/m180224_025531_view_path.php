<?php

use yii\db\Migration;

/**
 * Class m180224_025531_view_path
 */
class m180224_025531_view_path extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%widgets}}', 'view_path', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180224_025531_view_path cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180224_025531_view_path cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m180224_072412_alter_position
 */
class m180224_072412_alter_position extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%widgets}}','position', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180224_072412_alter_position cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180224_072412_alter_position cannot be reverted.\n";

        return false;
    }
    */
}

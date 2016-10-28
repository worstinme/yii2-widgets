<?php

use yii\db\Migration;

class m160428_084226_widgets_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%widgets}}', [
            'id' => $this->primaryKey(),   
            'widget' => $this->string(),         
            'name' => $this->string()->notNull(),
            'params'=> $this->text(),
            'css_class' => $this->string(),
            'state'=> $this->smallInteger()->defaultValue(1),
            'sort'=> $this->integer(),
            'position' => $this->string()->notNull(), 
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'cache'=> $this->smallInteger()->defaultValue(1),
            'lang' => $this->string(),
        ], $tableOptions);

        $this->createTable('{{%widget_bounds}}', [
            'id' => $this->primaryKey(),  
            'widget_id' => $this->integer()->notNull(),  
            'module' => $this->string(),  
            'controller' => $this->string(), 
            'action' => $this->string(), 
            'except' => $this->smallInteger()->defaultValue(1),
        ], $tableOptions);
               
    }

    public function safeDown()
    {
        $this->dropTable('{{%widgets}}');
        $this->dropTable('{{%widget_bounds}}');
        $this->dropTable('{{%widget_positions}}');
    }

}

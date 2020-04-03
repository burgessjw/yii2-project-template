<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class M200403020831CreateStudentTable
 */
class M200403020831CreateStudentTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student', [
            'id' => $this->primaryKey()->comment('主键ID'),
            'studentId' => $this->integer()->comment('学号'),
            'name' => $this->string(30)->notNull()->comment('姓名'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('student');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M200403020831CreateStudentTable cannot be reverted.\n";

        return false;
    }
    */
}

<?php

namespace common\models;

class Student extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'student';
    }
}
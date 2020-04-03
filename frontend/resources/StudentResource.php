<?php

namespace frontend\resources;

use common\models\Student;
use benbanfa\raddy\resources\AbstractResource;

class StudentResource extends AbstractResource
{
    public function getModelClass(): string
    {
        return Student::class;
    }
}

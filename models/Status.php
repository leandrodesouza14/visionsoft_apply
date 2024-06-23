<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Task;

class Status extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */

    public static function tableName()
    {
        return 'status';
    }

    /**
     * This is the method that returns the relationship with the task table.
     * @return yii\db\ActiveQuery a ActiveQuery object for retrieving multiple rows of Task model.
     */

    public function getTasks()
    {
        return $this->hasMany(Task::class, ['status_id' => 'id']);
    }
}

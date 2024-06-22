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

    public function getTasks()
   {
       return $this->hasMany(Task::class, ['status_id' => 'id']);
   }
}

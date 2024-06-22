<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Status;

class Task extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'task';
    }

    public function rules()
    {
        return [
            [['title'], 'required', 'message' => 'O título é obrigatório.'],
            [['title'], 'string', 'max' => 255, 'tooLong' => 'O título não pode exceder 255 caracteres.'],
            [['description'], 'required', 'message' => 'A descrição é obrigatória.'],
            [['description'], 'string', 'max' => 510, 'tooLong' => 'A descrição não pode exceder 510 caracteres.'],
            [['status'], 'integer', 'message' => 'O status deve ser um número inteiro.'],
            [['conclusion_at'], 'date', 'format' => 'php:Y-m-d', 'message' => 'A data de conclusão deve estar no formato AAAA-MM-DD.'],
        ];
    }
    
    public function getStatus()
   {
       return $this->hasOne(Status::class, ['id' => 'status_id']);
   }
}

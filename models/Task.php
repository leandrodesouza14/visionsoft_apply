<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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


    /**
     * This is the method that defines the validation rules for the fields.
     * @return array
     */

    public function rules()
    {
        return [
            [['title'], 'required', 'message' => 'O título é obrigatório.'],
            [['title'], 'string', 'max' => 255, 'tooLong' => 'O título não pode exceder 255 caracteres.'],
            [['description'], 'required', 'message' => 'A descrição é obrigatória.'],
            [['description'], 'string', 'max' => 510, 'tooLong' => 'A descrição não pode exceder 510 caracteres.'],
            [['status_id'], 'integer', 'message' => 'O status deve ser um número inteiro.'],
            [['status_id'], 'required', 'message' => 'O status é obrigatório'],
            [['conclusion_at'], 'date', 'format' => 'php:Y-m-d', 'message' => 'A data de conclusão deve estar no formato AAAA-MM-DD.'],
            ['conclusion_at', 'validateConclusionAt'],
        ];
    }

    /**
     * @param string $attribute the attribute currently being validated
     * @param mixed $params the value of the "params" given in the rule
     * @param \yii\validators\InlineValidator $validator related InlineValidator instance.
     * IMPORTANT: The database guarantees, via Trigger, that only one status record will contain a 'completed' flag.
     */

    public function validateConclusionAt($attribute, $params, $validator)
    {
        $today = date('Y-m-d');

        if ($this->$attribute > $today) {
            $validator->addError($this, $attribute, 'A data "{value}" para "{attribute}", deve ser menor que a data atual.');
        }

        $endStatus = Status::find()->where(['completed' => true])->one();
        if ($this->status_id != $endStatus->id) {
            $validator->addError($this, $attribute, 'A "{attribute}", só deve ser inserida para uma tarefa com estado Finalizado');
        }
    }

    /**
     * This is the method that defines the labels for each field.
     * @return array
     */

    public function attributeLabels()
    {
        return [
            'title' => 'Título',
            'description' => 'Descrição',
            'created_at' => 'Data de Criação',
            'conclusion_at' => 'Data de Conclusão',
            'status' => 'Estado',
        ];
    }

    /**
     * This method defines the current date as the default value for insertion in the 'created_at' field.
     * @return date
     */

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => function () {
                    return date('Y-m-d');
                },
            ],
        ];
    }

    /**
     * This is the method that returns the relationship with the status table.
     * @return yii\db\ActiveQuery a ActiveQuery object for retrieving the related Status model.
     */

    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}

<?php

namespace frontend\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $workout_set_id;

    public function rules()
    {
        return [
            [['workout_set_id'], 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'workout_set_id' => 'Набор упражнений',
        ];
    }
}
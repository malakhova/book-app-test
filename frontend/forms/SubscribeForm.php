<?php

namespace frontend\forms;

use yii\base\Model;

class SubscribeForm extends Model
{
    public string $phone;
    public int $authorId;

    public function rules(): array
    {
        return [
            [['phone', 'authorId'], 'required'],
            ['authorId', 'number'],
            //todo валидация номера телефона (либо кастом под требования, либо yii2-phone-validator)
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'phone' => 'Phone',
            'authorId' => 'Author',
        ];
    }
}

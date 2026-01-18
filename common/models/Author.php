<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $patronymic_name
 * @property string $created_at
 * @property string $updated_at
 */
class Author extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName():string
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['patronymic_name'], 'default', 'value' => null],
            [['first_name', 'last_name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'last_name', 'patronymic_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'patronymic_name' => 'Patronymic Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

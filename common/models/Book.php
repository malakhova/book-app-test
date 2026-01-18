<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $title
 * @property int $publish_year
 * @property string|null $description
 * @property string $isbn
 * @property string|null $cover_image
 * @property string $created_at
 * @property string $updated_at
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['description', 'cover_image'], 'default', 'value' => null],
            [['title', 'publish_year', 'isbn', 'created_at', 'updated_at'], 'required'],
            [['publish_year'], 'integer'],
            [['description', 'cover_image'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 20],
            [['isbn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'publish_year' => 'Publish Year',
            'description' => 'Description',
            'isbn' => 'Isbn',
            'cover_image' => 'Cover Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

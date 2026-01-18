<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "subscription".
 *
 * @property int $id
 * @property int $author_id
 * @property string $phone
 * @property int|null $is_active
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $last_notified_at
 */
class Subscription extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_notified_at'], 'default', 'value' => null],
            [['is_active'], 'default', 'value' => 1],
            [['author_id', 'phone'], 'required'],
            [['author_id', 'is_active'], 'integer'],
            [['created_at', 'updated_at', 'last_notified_at'], 'safe'],
            [['phone'], 'string', 'max' => 20],
            [['phone', 'author_id'], 'unique', 'targetAttribute' => ['phone', 'author_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'phone' => 'Phone',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_notified_at' => 'Last Notified At',
        ];
    }
}

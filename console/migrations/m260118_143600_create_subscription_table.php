<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscription}}`.
 */
class m260118_143600_create_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subscription', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'phone' => $this->string(20)->notNull(),
            'is_active' => $this->boolean()->defaultValue(true), // на будущее, если нужно будет делать отписку
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            'last_notified_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('idx_subscription_author_active', 'subscription', ['author_id', 'is_active']);
        $this->createIndex('idx_subscription_phone', 'subscription', 'phone');
        $this->createIndex('uniq_phone_author', 'subscription', ['phone', 'author_id'], true);
        $this->addForeignKey(
            'fk-subscription-author_id',
            'subscription',
            'author_id',
            'author',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-subscription-author_id', 'subscription');
        $this->dropIndex('uniq_phone_author', 'subscription');
        $this->dropIndex('idx_subscription_phone', 'subscription');
        $this->dropIndex('idx_subscription_author_active', 'subscription');
        $this->dropTable('subscription');
    }
}

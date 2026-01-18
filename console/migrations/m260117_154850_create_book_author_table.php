<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m260117_154850_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Связь книга-автор
        $this->createTable('book_author', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('pk_book_author', 'book_author', ['book_id', 'author_id']);

        $this->createIndex('idx-book_author-book_id', 'book_author', 'book_id');
        $this->addForeignKey(
            'fk-book_author-book_id',
            'book_author',
            'book_id',
            'book',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createIndex('idx-book_author-author_id', 'book_author', 'author_id');
        $this->addForeignKey(
            'fk-book_author-author_id',
            'book_author',
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
        $this->dropForeignKey('fk-book_author-author_id', 'book_author');
        $this->dropIndex('idx-book_author-author_id', 'book_author');
        $this->dropForeignKey('fk-book_author-book_id', 'book_author');
        $this->dropIndex('idx-book_author-book_id', 'book_author');
        $this->dropTable('book_author');
    }
}

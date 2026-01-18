<?php

namespace common\repositories;

use common\dto\BookWithAuthorsDto;
use common\mapper\Mapper;
use common\models\Author;
use common\models\Book;
use yii\db\Expression;
use yii\db\Query;

class BookRepository implements BookRepositoryInterface
{
    public function __construct(
        protected Mapper $mapper
    ) {}

    /**
     * @inheritDoc
     */
    public function findOneById(int $id): ?Book
    {
        return Book::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public function findOneByIdWithAuthors(int $id): ?BookWithAuthorsDto
    {
        $authorNamesExpr = new Expression("
                GROUP_CONCAT(
                    CONCAT_WS(' ', author.last_name, author.first_name, author.patronymic_name) 
                    ORDER BY author.last_name
                    SEPARATOR ', '
                )
                ");
        $authorIdsExpr = new Expression("GROUP_CONCAT(author.id ORDER BY author.last_name)");
        $source = new Query()
            ->select([
                BookWithAuthorsDto::ATTR_BOOK_ID => 'book.id',
                BookWithAuthorsDto::ATTR_TITLE => 'book.title',
                BookWithAuthorsDto::ATTR_PUBLISH_YEAR => 'book.publish_year',
                BookWithAuthorsDto::ATTR_DESCRIPTION => 'book.description',
                BookWithAuthorsDto::ATTR_ISBN => 'book.isbn',
                BookWithAuthorsDto::ATTR_COVER => 'book.cover_image',
                BookWithAuthorsDto::ATTR_CREATED_AT => 'book.created_at',
                BookWithAuthorsDto::ATTR_UPDATED_AT => 'book.updated_at',
                BookWithAuthorsDto::ATTR_AUTHORS_IDS => $authorIdsExpr,
                BookWithAuthorsDto::ATTR_AUTHORS_NAMES => $authorNamesExpr,
            ])
            ->from(Book::tableName())
            ->leftJoin('book_author', 'book.id = book_author.book_id')
            ->leftJoin(Author::tableName(), 'book_author.author_id = author.id')
            ->where(['book.id' => $id])
            ->groupBy('book.id')
            ->one();
        return $this->mapper->map($source, BookWithAuthorsDto::class);
    }
}

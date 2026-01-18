<?php

namespace common\repositories;

use common\dto\AuthorBookCountDto;
use common\mapper\Mapper;
use common\models\Author;
use common\models\Book;
use yii\db\Expression;
use yii\db\Query;

class AuthorRepository implements AuthorRepositoryInterface
{
    protected Mapper $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @inheritDoc
     */
    public function findOneById(int $id): ?Author
    {
        return Author::findOne($id);
    }

    /**
     * @inheritDoc
     */
    public function findTopAuthorsByYear(int $year, int $limit): array
    {
        $sources = new Query()
            ->select([
                AuthorBookCountDto::ATTR_AUTHOR_ID => 'author.id',
                AuthorBookCountDto::ATTR_AUTHOR_LAST_NAME => 'author.last_name',
                AuthorBookCountDto::ATTR_AUTHOR_FIRST_NAME => 'author.first_name',
                AuthorBookCountDto::ATTR_AUTHOR_PATRONYMIC => 'author.patronymic_name',
                AuthorBookCountDto::ATTR_BOOK_COUNT => new Expression('COUNT(DISTINCT book_author.book_id)')
            ])
            ->from(Author::tableName())
            ->innerJoin('book_author', 'author.id = book_author.author_id')
            ->innerJoin(Book::tableName(), 'book_author.book_id = book.id')
            ->where(['book.publish_year' => $year])
            ->groupBy('author.id')
            ->orderBy([
                AuthorBookCountDto::ATTR_BOOK_COUNT => SORT_DESC,
                AuthorBookCountDto::ATTR_AUTHOR_LAST_NAME  => SORT_ASC,
            ])
            ->limit($limit)
            ->all();
        return $this->mapper->mapItems($sources, AuthorBookCountDto::class);
    }
}

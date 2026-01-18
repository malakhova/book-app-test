<?php

namespace backend\services;

use common\dto\BookWithAuthorsDto;
use common\models\Book;
use common\repositories\BookRepositoryInterface;
use yii\web\NotFoundHttpException;

class BookService implements BookServiceInterface
{
    public function __construct(
        protected BookRepositoryInterface $bookRepository
    ) {}

    /**
     * @inheritDoc
     */
    public function getOneById(int $id): Book
    {
        $book = $this->bookRepository->findOneById($id);
        if (null === $book) {
            throw new NotFoundHttpException('The requested book does not exist.');
        }
        return $book;
    }

    /**
     * @inheritDoc
     */
    public function getOneByIdWithAuthors(int $id): BookWithAuthorsDto
    {
        $book = $this->bookRepository->findOneByIdWithAuthors($id);
        if (null === $book) {
            throw new NotFoundHttpException('The requested book does not exist.');
        }
        return $book;
    }

    /**
     * @inheritDoc
     */
    public function createByParams(array $params): Book
    {
        $book = new Book();
        if (empty($params)) {
            return $book;
        }
        $book->load($params);
        $book->save();
        return $book;
    }

    /**
     * @inheritDoc
     */
    public function update(Book $book, array $params): bool
    {
        if (empty($params)) {
            return false;
        }
        if (!$book->load($params)) {
            return false;
        }
        return $book->save();
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        $book = $this->getOneById($id);
        return $book->delete();
    }
}

<?php

namespace backend\services;

use common\dto\BookWithAuthorsDto;
use common\models\Book;

interface BookServiceInterface
{
    /**
     * @param int $id
     * @return Book
     */
    public function getOneById(int $id): Book;

    /**
     * @param int $id
     * @return BookWithAuthorsDto
     */
    public function getOneByIdWithAuthors(int $id): BookWithAuthorsDto;

    /**
     * @param array $params
     * @return Book
     */
    public function createByParams(array $params): Book;

    /**
     * @param Book $book
     * @param array $params
     * @return bool
     */
    public function update(Book $book, array $params): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}

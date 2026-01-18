<?php

namespace backend\services;

use common\models\Author;

interface AuthorServiceInterface
{
    /**
     * @param int $id
     * @return Author
     */
    public function getOneById(int $id): Author;

    /**
     * @param int $id
     * @return Author
     */
    public function getOneByIdWithAuthors(int $id): Author;

    /**
     * @param array $params
     * @return Author
     */
    public function createByParams(array $params): Author;

    /**
     * @param Author $author
     * @param array $params
     * @return bool
     */
    public function update(Author $author, array $params): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}

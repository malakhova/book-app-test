<?php

namespace backend\services;

use backend\services\AuthorServiceInterface;
use common\models\Author;

class AuthorService implements AuthorServiceInterface
{

    /**
     * @inheritDoc
     */
    public function getOneById(int $id): Author
    {
        // TODO: Implement getOneById() method.
    }

    /**
     * @inheritDoc
     */
    public function getOneByIdWithAuthors(int $id): Author
    {
        // TODO: Implement getOneByIdWithAuthors() method.
    }

    /**
     * @inheritDoc
     */
    public function createByParams(array $params): Author
    {
        $author = new Author();
        if (empty($params)) {
            return $author;
        }
        $author->load($params);
        $author->save();
        return $author;
    }

    /**
     * @inheritDoc
     */
    public function update(Author $author, array $params): bool
    {
        // TODO: Implement update() method.
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        // TODO: Implement deleteById() method.
    }
}

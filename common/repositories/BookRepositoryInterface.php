<?php

namespace common\repositories;

use common\dto\BookWithAuthorsDto;
use common\models\Book;

interface BookRepositoryInterface
{
    /**
     * @param int $id
     * @return Book|null
     */
    public function findOneById(int $id): ?Book;

    /**
     * @param int $id
     * @return BookWithAuthorsDto|null
     */
    public function findOneByIdWithAuthors(int $id): ?BookWithAuthorsDto;
}

<?php

namespace common\repositories;

use common\dto\AuthorBookCountDto;
use common\models\Author;

interface AuthorRepositoryInterface
{
    /**
     * @param int $id
     * @return Author|null
     */
    public function findOneById(int $id): ?Author;

    /**
     * @param int $year
     * @param int $limit
     * @return AuthorBookCountDto[]
     */
    public function findTopAuthorsByYear(int $year, int $limit): array;
}

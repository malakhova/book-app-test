<?php

namespace frontend\services;

use common\repositories\AuthorRepositoryInterface;

class ReportService implements ReportServiceInterface
{
    public function __construct(
        protected AuthorRepositoryInterface $authorRepository
    ) {}

    /**
     * @inheritDoc
     */
    public function getAuthorReportByYear(int $year, int $limit): array
    {
        $topAuthors = $this->authorRepository->findTopAuthorsByYear($year, $limit);
        //todo можно преобразовать данные под вывод
        return $topAuthors;
    }
}

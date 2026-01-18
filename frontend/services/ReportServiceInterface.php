<?php

namespace frontend\services;

use common\dto\AuthorBookCountDto;

interface ReportServiceInterface
{
    /**
     * @param int $year
     * @param int $limit
     * @return AuthorBookCountDto[]
     */
    public function getAuthorReportByYear(int $year, int $limit): array;
}

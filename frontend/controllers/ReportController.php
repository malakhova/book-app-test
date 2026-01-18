<?php

namespace frontend\controllers;

use frontend\services\ReportServiceInterface;
use yii\web\Controller;

class ReportController extends Controller
{
    public const int TOP_AUTHORS_LIMIT = 10;

    public function __construct(
        $id,
        $module,
        protected ReportServiceInterface $reportService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @param int $year
     * @return string
     */
    public function actionTopTenAuthors(int $year): string
    {
        $topAuthors = $this->reportService->getAuthorReportByYear($year, self::TOP_AUTHORS_LIMIT);
        return $this->render('top-ten-authors', ['topAuthors' => $topAuthors]);
    }
}

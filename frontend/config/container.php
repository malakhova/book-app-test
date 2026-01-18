<?php

/* @var $params array */

use frontend\services\ReportService;
use frontend\services\ReportServiceInterface;
use frontend\services\SubscriptionService;
use frontend\services\SubscriptionServiceInterface;

return [
    'singletons' => [
        ReportServiceInterface::class => ReportService::class,
        SubscriptionServiceInterface::class => SubscriptionService::class,
    ],
];

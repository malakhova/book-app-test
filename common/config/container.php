<?php

use common\repositories\AuthorRepository;
use common\repositories\AuthorRepositoryInterface;
use common\repositories\BookRepository;
use common\repositories\BookRepositoryInterface;
use common\repositories\SubscriptionRepository;
use common\repositories\SubscriptionRepositoryInterface;
use common\services\NotificationService;
use common\services\NotificationServiceInterface;
use common\services\SmsSenderInterface;

/* @var $params array */

return [
    'singletons' => [
        AuthorRepositoryInterface::class => AuthorRepository::class,
        BookRepositoryInterface::class => BookRepository::class,
        SubscriptionRepositoryInterface::class => SubscriptionRepository::class,

        NotificationServiceInterface::class => NotificationService::class,
        SmsSenderInterface::class => SmsSenderInterface::class,
    ],
];

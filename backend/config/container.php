<?php

/* @var $params array */

use backend\services\AuthorService;
use backend\services\AuthorServiceInterface;
use backend\services\BookService;
use backend\services\BookServiceInterface;

return [
    'singletons' => [
        AuthorServiceInterface::class => AuthorService::class,
        BookServiceInterface::class => BookService::class,
    ],
];

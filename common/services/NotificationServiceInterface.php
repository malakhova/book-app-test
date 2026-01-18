<?php

namespace common\services;

interface NotificationServiceInterface
{
    /**
     * @param int $bookId
     */
    public function notifySubscribersByBookId(int $bookId): void;
}

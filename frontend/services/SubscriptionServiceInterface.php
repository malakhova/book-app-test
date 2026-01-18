<?php

namespace frontend\services;

use common\models\Subscription;

interface SubscriptionServiceInterface
{
    /**
     * @param string $phone
     * @param int $authorId
     * @return Subscription
     */
    public function createSubscription(string $phone, int $authorId): Subscription;
}

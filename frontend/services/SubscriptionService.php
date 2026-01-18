<?php

namespace frontend\services;

use common\models\Subscription;
use frontend\services\SubscriptionServiceInterface;

class SubscriptionService implements SubscriptionServiceInterface
{
    /**
     * @inheritDoc
     */
    public function createSubscription(string $phone, int $authorId): Subscription
    {
        $subscription = new Subscription();
        $subscription->phone = $phone;
        $subscription->author_id = $authorId;
        $subscription->is_active = true;
        $subscription->save();
        return $subscription;
    }
}

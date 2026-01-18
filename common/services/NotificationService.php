<?php

namespace common\services;

use common\dto\BookWithAuthorsDto;
use common\dto\SubscriptionWithAuthorDto;
use common\repositories\BookRepositoryInterface;
use common\repositories\SubscriptionRepositoryInterface;

class NotificationService implements NotificationServiceInterface
{
    public function __construct(
        protected BookRepositoryInterface         $bookRepository,
        protected SubscriptionRepositoryInterface $subscriptionRepository,
        protected SmsSenderInterface              $smsSender,
    ) {}

    /**
     * @inheritDoc
     */
    public function notifySubscribersByBookId(int $bookId): void
    {
        $bookWithAuthors = $this->bookRepository->findOneByIdWithAuthors($bookId);
        $subscriptions = $this->subscriptionRepository->findAllByAuthorsIds($bookWithAuthors->getAuthorsIdsArray());
        foreach ($subscriptions as $subscription) {
            $this->sendSmsToSubscriber($subscription, $bookWithAuthors);
        }
    }

    /**
     * @param SubscriptionWithAuthorDto $subscription
     * @param BookWithAuthorsDto $book
     */
    private function sendSmsToSubscriber(SubscriptionWithAuthorDto $subscription, BookWithAuthorsDto $book): void
    {
        $message = $this->createSmsMessage($book, $subscription);
        $this->smsSender->send($subscription->phone, $message);
    }

    /**
     * @param BookWithAuthorsDto $book
     * @param SubscriptionWithAuthorDto $subscription
     * @return string
     */
    private function createSmsMessage(BookWithAuthorsDto $book, SubscriptionWithAuthorDto $subscription): string
    {
        //todo функция createSmsMessage
        return '';
    }
}

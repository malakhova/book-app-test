<?php

namespace common\repositories;

use common\dto\SubscriptionWithAuthorDto;

interface SubscriptionRepositoryInterface
{
    /**
     * @param int[] $authorsIds
     * @return SubscriptionWithAuthorDto[]
     */
    public function findAllByAuthorsIds(array $authorsIds): array;
}

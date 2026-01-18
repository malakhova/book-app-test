<?php

namespace common\repositories;

use common\dto\SubscriptionWithAuthorDto;
use common\mapper\Mapper;
use common\models\Author;
use common\models\Subscription;
use yii\db\Query;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    public function __construct(
        protected Mapper $mapper
    ){
    }

    /**
     * @inheritDoc
     */
    public function findAllByAuthorsIds(array $authorsIds): array
    {
        $sources = new Query()
            ->select([
                SubscriptionWithAuthorDto::ATTR_ID => 's.id',
                SubscriptionWithAuthorDto::ATTR_PHONE => 's.phone',
                SubscriptionWithAuthorDto::ATTR_AUTHOR_ID => 'a.id as author_id',
                SubscriptionWithAuthorDto::ATTR_AUTHOR_LAST_NAME => 'a.last_name',
                SubscriptionWithAuthorDto::ATTR_AUTHOR_FIRST_NAME => 'a.first_name',
                SubscriptionWithAuthorDto::ATTR_AUTHOR_PATRONYMIC => 'a.patronymic_name',
            ])
            ->from(['s' => Subscription::tableName()])
            ->innerJoin(['a' => Author::tableName()], 's.author_id = a.id')
            ->andWhere(['a.id' => $authorsIds])
            ->all();
        return $this->mapper->mapItems($sources, SubscriptionWithAuthorDto::class);
    }
}

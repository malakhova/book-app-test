<?php

namespace common\dto;

class SubscriptionWithAuthorDto
{
    public const string ATTR_ID = 'id';
    public const string ATTR_PHONE = 'phone';
    public const string ATTR_AUTHOR_ID = 'authorId';
    public const string ATTR_AUTHOR_FIRST_NAME = 'authorFirstName';
    public const string ATTR_AUTHOR_LAST_NAME = 'authorLastNameName';
    public const string ATTR_AUTHOR_PATRONYMIC = 'authorPatronymicName';

    public int $id;
    public string $phone;
    public int $authorId;
    public string $authorFirstName;
    public string $authorLastNameName;
    public string $authorPatronymicName;

    public function getAuthorFullName(): string
    {
        return $this->authorFirstName . ' ' . $this->authorLastNameName;
    }
}

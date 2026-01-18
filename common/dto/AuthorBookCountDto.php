<?php

namespace common\dto;

class AuthorBookCountDto
{
    public const string ATTR_AUTHOR_ID = 'authorId';
    public const string ATTR_AUTHOR_FIRST_NAME = 'authorFirstName';
    public const string ATTR_AUTHOR_LAST_NAME = 'authorLastNameName';
    public const string ATTR_AUTHOR_PATRONYMIC = 'authorPatronymicName';
    public const string ATTR_BOOK_COUNT = 'bookCount';

    public int $authorId;
    public string $authorFirstName;
    public string $authorLastNameName;
    public string $authorPatronymicName;
    public int $bookCount;
}

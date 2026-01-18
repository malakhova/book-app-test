<?php

namespace common\dto;

class BookWithAuthorsDto
{
    public const string ATTR_BOOK_ID = 'bookId';
    public const string ATTR_TITLE = 'title';
    public const string ATTR_PUBLISH_YEAR = 'publishYear';
    public const string ATTR_DESCRIPTION = 'description';
    public const string ATTR_ISBN = 'isbn';
    public const string ATTR_COVER = 'coverImage';
    public const string ATTR_CREATED_AT = 'createdAt';
    public const string ATTR_UPDATED_AT = 'updatedAt';
    public const string ATTR_AUTHORS_IDS = 'authorsIds';
    public const string ATTR_AUTHORS_NAMES = 'authorsNames';

    public int $bookId;
    public string $title;
    public int $publishYear;
    public string $description;
    public string $isbn;
    public string|null $coverImage;
    public string $createdAt;
    public string $updatedAt;
    public string $authorsIds;
    public string $authorsNames;

    /**
     * @return string[]
     */
    public function getAuthorsIdsArray(): array
    {
        return explode(',', $this->authorsIds);
    }
}

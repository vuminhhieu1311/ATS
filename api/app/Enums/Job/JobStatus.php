<?php

namespace App\Enums\Job;

final class JobStatus
{
    public const DRAFT = 'draft';
    public const PUBLISHED = 'published';
    public const CLOSE = 'closed';
    public const PENDING = 'pending';

    public const ALL_STATUS = [
        self::DRAFT,
        self::PUBLISHED,
        self::CLOSE,
        self::PENDING,
    ];
}

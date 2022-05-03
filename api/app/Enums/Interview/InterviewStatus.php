<?php

namespace App\Enums\Interview;

final class InterviewStatus
{
    public const NEW = 'new';
    public const UPDATED = 'updated';
    public const INTERVIEWING = 'interviewing';
    public const FINISHED = 'finished';
    public const CANCELED = 'canceled';

    public const IN_PROGRESS = [
        self::NEW,
        self::INTERVIEWING,
        self::UPDATED,
    ];

    public const ALL = [
        self::NEW,
        self::INTERVIEWING,
        self::UPDATED,
        self::FINISHED,
        self::CANCELED,
    ];
}

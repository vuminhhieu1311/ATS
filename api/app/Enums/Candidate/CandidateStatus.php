<?php

namespace App\Enums\Candidate;

final class CandidateStatus
{
    public const NEW = 'new';
    public const IN_PROGRESS = 'in progress';
    public const HIRED = 'hired';
    public const REJECTED = 'rejected';

    public const ALL_STATUS = [
        self::NEW,
        self::IN_PROGRESS,
        self::HIRED,
        self::REJECTED,
    ];
}

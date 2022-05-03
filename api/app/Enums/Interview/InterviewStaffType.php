<?php

namespace App\Enums\Interview;

final class InterviewStaffType
{
    public const SCHEDULER = 'scheduler';
    public const INTERVIEWER = 'interviewer';

    public const ALL = [
        self::SCHEDULER,
        self::INTERVIEWER,
    ];
}

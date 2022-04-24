<?php

namespace App\Enums\Job;

final class EmploymentType
{
    public const FULL_TIME = 'full-time';
    public const PART_TIME = 'part-time';
    public const CONTRACT = 'contract';
    public const TEMPORARY = 'temporary';
    public const INTERNSHIP = 'internship';

    public const ALL_TYPE = [
        self::FULL_TIME,
        self::PART_TIME,
        self::CONTRACT,
        self::TEMPORARY,
        self::INTERNSHIP,
    ];
}

<?php

namespace App\Enums\MailTemplate;

final class MailTemplateKeyword
{
    public const CANDIDATE_NAME = '[CANDIDATE_NAME]';
    public const JOB_NAME = '[JOB_NAME]';
    public const INTERVIEW_START_TIME = '[INTERVIEW_START_TIME]';
    public const MEETING_LINK = '[MEETING_LINK]';

    public const ALL = [
        self::JOB_NAME,
        self::CANDIDATE_NAME,
        self::INTERVIEW_START_TIME,
        self::MEETING_LINK,
    ];
}

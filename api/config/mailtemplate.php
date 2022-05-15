<?php

return [
    '[JOB_NAME]' => [
        'description' => 'The name of the job',
        'reference_value' => 'candidateJob.job.name',
    ],
    '[CANDIDATE_NAME]' => [
        'description' => 'The candidate\'s name',
        'reference_value' => 'candidateJob.candidate.user.name',
    ],
    '[INTERVIEW_NAME]' => [
        'description' => 'The name of the interview',
        'reference_value' => 'name',
    ],
    '[INTERVIEW_START_TIME]' => [
        'description' => 'The starting time of the interview',
        'reference_value' => 'start_time',
    ],
    '[INTERVIEW_END_TIME]' => [
        'description' => 'The ending time of the interview',
        'reference_value' => 'end_time',
    ],
    '[SCHEDULER_NAME]' => [
        'description' => 'Name of HR who set the interview',
        'reference_value' => 'scheduler.user.name',
    ],
    '[HANGOUT_LINK]' => [
        'description' => 'The link of the online meeting',
        'reference_value' => 'link',
    ],
];

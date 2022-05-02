<?php

namespace App\Repositories\MailTemplate;

use App\Models\MailTemplate;
use App\Repositories\BaseRepository;

class MailTemplateRepository extends BaseRepository implements MailTemplateRepositoryInterface
{
    public function model()
    {
        return new MailTemplate();
    }
}

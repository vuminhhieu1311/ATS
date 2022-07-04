<?php

namespace App\Http\Controllers;

use App\Http\Resources\MailTemplateResource;
use App\Repositories\MailTemplate\MailTemplateRepositoryInterface;

class MailTemplateController extends Controller
{
    protected MailTemplateRepositoryInterface $mailTemplateRepo;

    public function __construct(MailTemplateRepositoryInterface $mailTemplateRepo)
    {
        $this->mailTemplateRepo = $mailTemplateRepo;
    }

    public function index()
    {
        $mailTemplates = $this->mailTemplateRepo->getAll();

        return MailTemplateResource::collection($mailTemplates);
    }
}

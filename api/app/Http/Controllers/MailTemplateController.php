<?php

namespace App\Http\Controllers;

use App\Http\Resources\MailTemplateResource;
use App\Models\MailTemplate;
use App\Repositories\MailTemplate\MailTemplateRepositoryInterface;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
    }

    public function show(MailTemplate $mailTemplate)
    {
        //
    }

    public function update(Request $request, MailTemplate $mailTemplate)
    {
        //
    }

    public function destroy(MailTemplate $mailTemplate)
    {
        //
    }
}

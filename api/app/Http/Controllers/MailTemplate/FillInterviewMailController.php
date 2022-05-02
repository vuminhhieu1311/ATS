<?php

namespace App\Http\Controllers\MailTemplate;

use App\Enums\MailTemplate\MailTemplateKeyWord;
use App\Http\Controllers\Controller;
use App\Http\Resources\MailTemplateResource;
use App\Models\Candidate;
use App\Models\MailTemplate;
use App\Services\MailTemplate\FillMailTemplate;
use Illuminate\Http\Request;

class FillInterviewMailController extends Controller
{
    public function __invoke(Request $request, MailTemplate $mailTemplate, Candidate $candidate)
    {
        $data = [
            MailTemplateKeyWord::CANDIDATE_NAME => $candidate->user->name,
            MailTemplateKeyWord::INTERVIEW_START_TIME => date('H:i (d/m/Y)', strtotime($request->input('startTime'))),
        ];

        $mailFilled = (new FillMailTemplate($mailTemplate, $data))->fill();

        return MailTemplateResource::make($mailFilled);
    }
}

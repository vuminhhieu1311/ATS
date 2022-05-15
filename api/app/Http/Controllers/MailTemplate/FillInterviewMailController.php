<?php

namespace App\Http\Controllers\MailTemplate;

use App\Helper\FillMailTemplate;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\MailTemplate;
use Exception;
use Illuminate\Http\Request;

class FillInterviewMailController extends Controller
{
    public function __invoke(Request $request, MailTemplate $mailTemplate, Interview $interview)
    {
        try {
            $result = (new FillMailTemplate($interview, $mailTemplate))->fill();

            return response()->json([
                'title' => $result[0],
                'content' => $result[1],
            ]);
        } catch (Exception $e) {
            logger($e);
            return false;
        }
    }
}

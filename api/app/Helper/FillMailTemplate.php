<?php

namespace App\Helper;

use App\Models\Interview;
use App\Models\MailTemplate;
use Exception;
use Illuminate\Support\Arr;

class FillMailTemplate
{
    protected Interview $interview;
    protected MailTemplate $mailTemplate;

    public function __construct(Interview $interview, MailTemplate $mailTemplate)
    {
        $this->interview = $interview;
        $this->mailTemplate = $mailTemplate;
    }

    public function fill()
    {
        $this->interview->start_time = date('H:i (d/m/Y)', strtotime($this->interview->start_time));
        $this->interview->end_time = date('H:i (d/m/Y)', strtotime($this->interview->start_time));
        $title = $this->mailTemplate->title;
        $content = $this->mailTemplate->content;
        $templateKeys = config('mailtemplate');
        preg_match_all('/\[\w*]/', $title . $content, $matches);
        $matches = array_unique(Arr::get($matches, '0', []));

        $cloneMatches = [];

        foreach ($matches as $match) {
            if (!isset($templateKeys[$match])) {
                continue;
            }

            $references = explode('.', $templateKeys[$match]['reference_value']);
            $data = $this->interview;

            try {
                foreach ($references as $reference) {
                    $data = $data->{$reference};
                }

                $cloneMatches[$match] = $data;
            } catch (Exception $e) {
                $cloneMatches[$match] = '';
                throw $e;
            }
        }

        return [
            str_replace($matches, $cloneMatches, $title),
            str_replace($matches, $cloneMatches, $content),
        ];
    }
}

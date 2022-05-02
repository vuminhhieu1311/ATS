<?php

namespace App\Services\MailTemplate;

use App\Enums\MailTemplate\MailTemplateKeyWord;
use App\Models\MailTemplate;

class FillMailTemplate
{
    protected MailTemplate $mailTemplate;
    protected array $data;

    public function __construct(MailTemplate $mailTemplate, $data = [])
    {
        $this->mailTemplate = $mailTemplate;
        $this->data = $data;
    }

    public function fill()
    {
        $title = $this->mailTemplate->title;
        $content = $this->mailTemplate->content;

        foreach (MailTemplateKeyWord::ALL as $keyword) {
            if (array_key_exists($keyword, $this->data) && str_contains($title . $content, $keyword)) {
                $title = str_replace($keyword, $this->data[$keyword], $title);
                $content = str_replace($keyword, $this->data[$keyword], $content);
            }
        }

        $this->mailTemplate->title = $title;
        $this->mailTemplate->content = $content;

        return $this->mailTemplate;
    }
}

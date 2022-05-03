<?php

namespace App\Http\Requests\Interview;

use Illuminate\Foundation\Http\FormRequest;

class InterviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'startTime' => 'required|date|after_or_equal:now',
            'endTime' => 'required|date|after_or_equal:startTime',
            'note' => 'string|nullable',
            'staffs' => 'required|array',
            'staffs.*' => 'exists:staffs,id',
            'roomId' => 'nullable|exists:rooms,id',
            'isOnline' => 'boolean',
            'isSendMail' => 'boolean',
            'mailTemplateId' => 'nullable|exists:mail_templates,id',
            'mailTitle' => 'string|nullable',
            'mailContent' => 'string|nullable',
        ];
    }
}

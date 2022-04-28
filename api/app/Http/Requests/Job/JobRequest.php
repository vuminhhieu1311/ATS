<?php

namespace App\Http\Requests\Job;

use App\Enums\Job\EmploymentType;
use App\Enums\Job\OfferCurrency;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'employmentType' => 'required|in:'.implode(',', EmploymentType::ALL_TYPE),
            'minOffer' => 'integer|nullable',
            'maxOffer' => 'integer|nullable',
            'currency' => 'required|in:'.implode(',', OfferCurrency::ALL_CURRENCY),
            'deadline' => 'date|nullable',
            'description' => 'string|nullable',
            'requirement' => 'string|nullable',
            'benefit' => 'string|nullable',
            'pipelineId' => 'required|exists:pipelines,id',
        ];
    }
}

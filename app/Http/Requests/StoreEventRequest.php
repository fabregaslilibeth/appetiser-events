<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name' => 'required',
            'dateFrom' => 'required|date',
            'dateTo' => 'required|date|after:dateFrom',
            'includedDays' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Event name is required.',
            'dateFrom.required' => 'The start date is required.',
            'dateTo.required' => 'The end date is required.',
            'dateTo.after' => 'End date must be later than start date.',
            'includedDays.required' => 'At least one day is required.'
        ];
    }
}

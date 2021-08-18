<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class EmiHistoryPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'principal_amount'=>'required|integer|min:100',
            'rate_of_interest'=>'required|numeric|min:1|max:100',
            'durations'=>'required|integer|min:1',
        ];
    }
}

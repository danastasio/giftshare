<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		// Need to figure out if user owns $object. If they do, allow.
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
			'item' => 'sometimes|required',
			'user' => 'sometimes|required',
			'id' => 'sometimes|required',
        ];
    }
}

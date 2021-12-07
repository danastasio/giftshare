<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\Item;

class ClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return match ($this->method()) {
    		"GET"	=> \Auth::check(),
    		"POST"	=> \Auth::check(),
    		"PUT"	=> Gate::allows('update-claim', Item::find($this->item_id)),
    		"DELETE"=> Gate::allows('delete-claim', Item::find($this->item_id)),
    		default => false,
    	};
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

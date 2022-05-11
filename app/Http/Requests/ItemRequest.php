<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;
use App\Enums\Priority;
use Illuminate\Support\Facades\Gate;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return match ($this->method()) {
    		"GET"		=> \Auth::check(),
    		"POST"		=> \Auth::check(),
    		"PUT"		=> Item::find($this->route('item'))->owner()->is(auth()->user()),
    		"DELETE"	=> Item::find($this->route('item'))->owner()->is(auth()->user()),
    		default		=> false,
    	};
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
    	return match($this->method()) {
    		"GET"	=> [],
			"POST"	=> [
				'name' => 'required',
				'url'  => 'url|nullable',
				'description' => 'nullable|string|max:256',
			],
			"PUT"	=> [
				'name' => 'required',
				'url'  => 'url|nullable',
				'description' => 'nullable|string|max:256',
			],
			"DELETE"	=> [
				'id' => 'required',
			],
    	};
    }
	public function prepareForValidation()
	{
		$this->merge([
			'id' => $this->route('item'),
		]);
	}
}

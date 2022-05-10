<?php

namespace App\Http\Requests;

use App\Models\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		return match ($this->method()) {
    		'GET', 'POST'	=> \Auth::check(),
    		'PUT'			=> Collection::find($this->id)->owner()->first()->is(auth()->user()),
    		'DELETE'		=> Collection::find($this->id)->owner()->first()->is(auth()->user()),
    		default			=> false,
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
    		'DELETE', => [
				'id' => 'required',
    		],
    		'POST', 'PUT' => [
    			'name' => 'required',
    		],
    	};
    }

	public function prepareForValidation()
	{
		$this->merge(['id' => $this->route('collection')]);
	}

}

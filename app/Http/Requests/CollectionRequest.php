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
		return match ($this->route()->action['as']) {
    		"list"			=> \Auth::check(),
    		"collection.index"	=> \Auth::check(),
    		"collection.store"	=> \Auth::check(),
    		"collection.update"	=> Gate::allows('update-collection', Item::find($this->id)),
    		"collection.destroy"	=> function() {
    			return true;
    		},
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
    		"DELETE" => [
				'id' => 'required',
    		],
    		"POST"	 => [
    			'name' => 'required',
    		],
    	};
    }

	public function prepareForValidation()
	{
		$this->merge(['id' => $this->route('collection')]);
	}

    public function validationData()
    {
    	return array_merge($this->all(), [
            'user_id' => $this->user()->id,
        ]);
    }

}

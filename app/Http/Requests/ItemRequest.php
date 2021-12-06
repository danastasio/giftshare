<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Item;
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
  	return match ($this->route()->uri) {
    		"list",			"api/v1/item/list"		=> \Auth::check(),
    		"dashboard", 	"api/v1/item/dashboard"	=> \Auth::check(),
    		"store", 		"api/v1/item/store"		=> \Auth::check(),
    		"item/{item}",	"api/v1/item/update"	=> Gate::allows('update-item', Item::find($this->id)),
    		"destroy",		"api/v1/item/destroy"	=> Gate::allows('delete-item', Item::find($this->id)),
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
        return [
            'id' => 'sometimes|required',
            'name' => 'sometimes|required',
            'url' => 'sometimes|nullable|url',
            'description' => 'nullable|string|max:256',
            'owner_id' => '',
        ];
    }

    public function validationData()
    {
    	return array_merge($this->all(), [
            'owner_id' => $this->user()->id,
        ]);
    }
}

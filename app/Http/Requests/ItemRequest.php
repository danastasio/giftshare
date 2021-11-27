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
    	return match ($this->route()->action['as']) {
    		"list"			=> \Auth::check(),
    		"item.index"	=> \Auth::check(),
    		"item.store"	=> \Auth::check(),
    		"item.update"	=> Gate::allows('update-item', Item::find($this->id)),
    		"item.destroy"	=> Gate::allows('delete-item', Item::find($this->id)),
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

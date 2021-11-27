<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ShareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return match ($this->route()->action['as']) {
    		"share.index"	=> \Auth::check(),
    		"share.store"	=> \Auth::check(),
    		"share.destroy"	=> Gate::allows('delete-share', UserUsers::find($this->id)),
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
            'email' => 'required|
            	max:255|
            	exists:App\Models\User,email|
            	not_in:' . auth()->user()->email,
        ];
    }

    public function vaidated()
    {
    	return array_merge($this->all(), [
            'owner_id' => $this->user()->id,
            'email'    => strtolower($this->email),
        ]);
    }
}

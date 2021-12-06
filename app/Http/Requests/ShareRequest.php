<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\UserUsers;

class ShareRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	return match ($this->route()->uri) {
    		"index",	"api/v1/share/index"	=> \Auth::check(),
    		"share",	"api/v1/share/store"	=> \Auth::check(),
    		"share/{share}",	"api/v1/share/destroy"	=> Gate::allows('delete-share', $this->id),
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
    	return match ($this->route()->uri) {
        	"share", "api/v1/share/store"	=> [
        		'email' => 'required|max:255|exists:App\Models\User,email|not_in:' . $this->user()->email
        	],
        	"share/{share}", "api/v1/share/destroy" => [
        		'id' => 'required|exists:App\Models\UserUsers,id'
        	],
        };
    }

    public function vaidated()
    {
    	return array_merge($this->all(), [
            'owner_id'	=> $this->user()->id,
            'email'		=> strtolower($this->email),
            'id'		=> $this->id,
        ]);
    }

    public function messages()
    {
    	return [
    		'email.exists' => "Email not found or user doesn't exist",
    		'email.not_in' => "Cannot create a share with yourself",
    	];
    }
}

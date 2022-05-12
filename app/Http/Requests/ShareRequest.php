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
        $request = $this->request->all();
        return match ($this->route()->action['as'] ?? $this->route()->uri) {
            "share.index"	=> \Auth::check(),
            "share.store"	=> \Auth::check(),
            "share.destroy"	=> \Auth::check(),
            "qr"			=> \Auth::check(),
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
        return match ($this->route()->action['as'] ?? $this->route()->uri) {
            "share.store"	=> [
                'email' => 'required|max:255|exists:users,email|not_in:' . $this->user()->email
            ],
            "share.destroy" => [
                'id' => 'required',
            ],
            "qr"			=> [
                'email' => 'required',
            ]
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

    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('share'),
        ]);
    }
}

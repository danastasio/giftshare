<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Adminstatus extends Component
{
	public $user;
	public $is_admin;
	public $user_id;

	public function mount(User $user) {
		$this->user_id = $user->id;
	}

    public function render()
    {
        return view('livewire.adminstatus');
    }

    public function promote()
    {
		$user = User::find($this->user_id);
		$user->is_admin = 1;
		$user->save();
    }

    public function demote()
    {
		$user = User::find($this->user_id);
		$user->is_admin = 0;
		$user->save();
    }
}

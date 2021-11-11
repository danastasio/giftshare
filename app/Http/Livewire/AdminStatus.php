<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminStatus extends Component
{
	public $user;
	public $is_admin;
	public $user_id;

	public function mount(User $user) {
		$this->user_id = $user->id;
		$this->is_admin = $user->is_admin;
	}

    public function render()
    {
        return view('livewire.admin-status');
    }

    public function promote()
    {
		$user = User::find($this->user_id);
		$user->is_admin = 1;
		$this->is_admin = 1;
		$user->save();

    }

    public function demote()
    {
		$user = User::find($this->user_id);
		$user->is_admin = 0;
		$this->is_admin = 0;
		$user->save();
    }
}

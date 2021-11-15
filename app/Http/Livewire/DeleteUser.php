<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class DeleteUser extends Component
{
    public $user_id;

    public function mount(User $user)
    {
        $this->user_id = $user->id;
    }

    public function render()
    {
        return view('livewire.delete-user');
    }

    public function delete()
    {
        $user = User::find($this->user_id);
        $user->delete();
        $this->emit("document.getElementById('delete . $user->id\').classList.add('invisible');");
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserUsers;

class TogglePrivacy extends Component
{
    public $hidden;
    public $share;

    public function mount(UserUsers $share)
    {
        $this->share = $share;
    }

    public function render()
    {
        return view('livewire.toggle-privacy');
    }

    public function toggle_state()
    {
        if ($this->hidden) {
            $this->emit("toggle_privacy", "user".$this->share->owner->id);
            $this->hidden = false;
        } else {
            $this->hidden = true;
            $this->emit("toggle_privacy", "user".$this->share->owner->id);
        }
    }
}

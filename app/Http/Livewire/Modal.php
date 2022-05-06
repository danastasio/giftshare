<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
	public function mount($message)
	{
		$this->message = $message;
	}
    public function render()
    {
        return view('livewire.modal');
    }
}

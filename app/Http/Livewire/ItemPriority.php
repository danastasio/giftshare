<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemPriority extends Component
{
	public function mount($item)
	{
		$this->item = $item;
		$this->priority = $item->priority;
	}

	public function make_high_priority()
	{
		$this->item->priority = 2;
		$this->item->save();
		$this->priority = 2;
	}

	public function make_normal_priority()
	{
		$this->item->priority = 1;
		$this->item->save();
		$this->priority = 1;
	}

	public function make_low_priority()
	{
		$this->item->priority = 0;
		$this->item->save();
		$this->priority = 0;
	}

    public function render()
    {
        return view('livewire.item-priority');
    }
}

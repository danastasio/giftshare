<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Enums\Priority;

class ItemPriority extends Component
{
    public function mount($item)
    {
        $this->item = $item;
        $this->priority = $item->priority;
    }

    public function make_high_priority()
    {
        $this->item->priority = Priority::HIGH;
        $this->item->save();
        $this->priority = Priority::HIGH;
    }

    public function make_normal_priority()
    {
        $this->item->priority = Priority::NORMAL;
        $this->item->save();
        $this->priority = Priority::NORMAL;
    }

    public function make_low_priority()
    {
        $this->item->priority = Priority::LOW;
        $this->item->save();
        $this->priority = Priority::LOW;
    }

    public function render()
    {
        return view('livewire.item-priority');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class TogglePurchase extends Component
{
    public $item_id;
    public $purchased;

    public function mount(Item $item)
    {
        $this->item_id = $item->id;
        $this->purchased = $item->purchased;
    }

    public function render()
    {
        return view('livewire.toggle-purchase');
    }

    public function toggle()
    {
        $item = Item::find($this->item_id);
        if ($this->purchased) {
            $item->purchased = false;
            $this->purchased = false;
            $item->save();
        } else {
            $this->purchased = true;
            $item->purchased = true;
            $item->save();
        }
    }
}

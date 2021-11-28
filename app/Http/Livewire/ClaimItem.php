<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class ClaimItem extends Component
{
    public $item;
    public $item_id;
    public $claimed;
    public $claimant_id;
    public $label;

    public function mount($item)
    {
        $this->item = $item;
        $this->item_id = $item->id;
        $this->claimed = $item->claimed;
        $this->claimant_id = $item->claimant_id;
    }

    public function claim()
    {
        $user_item = Item::find($this->item_id);
        if (!$user_item->claimed === true) {
            $user_item->claimed = true;
            $user_item->claimant_id = auth()->user()->id;
            $user_item->save();
            $this->claimed = true;
            $this->claimant_id = auth()->user()->id;
            $this->emit('toggle_claim', $this->item_id);
        } else {
        	$this->label = "Item was claimed while you were on this page";
        }
    }

    public function unclaim()
    {
        $user_item = Item::find($this->item_id);
        $user_item->claimed = false;
        $user_item->claimant_id = null;
        $user_item->purchased = false;
        $user_item->save();
        $this->claimed = false;
        $this->claimant_id = null;
        $this->emit('toggle_claim', $this->item_id);
    }

    public function render()
    {
        return view('livewire.claim-item');
    }
}

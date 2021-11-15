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

    public function mount($item)
    {
        $this->item = $item;
        $this->item_id = $item->id;
        $this->claimed = $item->claimed;
        $this->claimant_id = $item->claimant_id;
    }

    public function claim()
    {
        $user_item = Item::where('id', $this->item_id)->get();
        if (!$user_item[0]['claimed'] == 1) {
            $user_item[0]['claimed'] = 1;
            $user_item[0]['claimant_id'] = auth()->user()->id;
            $user_item[0]->save();
            $this->claimed = true;
            $this->claimant_id = auth()->user()->id;
        } else {
        	session()->flash('info', "Item was claimed while you were on this page");
        }
    }

    public function unclaim()
    {
        $user_item = Item::where('id', $this->item_id)->get();
        $user_item[0]['claimed'] = 0;
        $user_item[0]['claimant_id'] = null;
        $user_item[0]->save();
        $this->claimed = false;
        $this->claimant_id = null;
    }

    public function render()
    {
        return view('livewire.claim-item');
    }
}

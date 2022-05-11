<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\User;

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
        $this->claimant_id = $item->claimant()->first()->id ?? null;
    }

    public function claim()
    {
        $item = Item::find($this->item_id);

        if ($item->claimed === false) {
            auth()->user()->claims()->attach($item, ['owner_id' => $item->owner()->first()->id, 'claimant_id' => auth()->user()->id]);
            $item->claimed = true;
            $item->save();
            $this->claimed = auth()->user()->claims()->get()->contains($item);
            //$this->emit('toggle_claim', $this->item_id);
            $this->claimant_id = $item->claimant()->first()->id;
        } else {
            $this->label = "Item was claimed while you were on this page";
        }
    }

    public function unclaim()
    {
        $item = Item::find($this->item_id);
        auth()->user()->claims()->detach($item);
        $item->claimed = false;
        $item->save();
        $this->claimed = auth()->user()->claims()->get()->contains($item);
        //$this->emit('toggle_claim', $this->item_id);
    }

    public function render()
    {
        return view('livewire.claim-item');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class RestoreItem extends Component
{
	public $deleted_at;
	public $item_id;

	public function mount(Item $item)
	{
		$this->deleted_at = $item->deleted_at;
		$this->item_id = $item->id;
	}

    public function render()
    {
        return view('livewire.restore-item');
    }

    public function restore()
    {
    	$item = Item::withTrashed()->find($this->item_id)->restore();
    	$this->deleted_at = null;
    }
}

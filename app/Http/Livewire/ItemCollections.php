<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ItemCollections extends Component
{
    public function mount($item, $collection)
    {
        $this->item = $item;
        $this->collection = $collection;
        $this->in_collection = $collection->items()->get()->contains($item);
    }

    public function add_to_collection()
    {
        $this->collection->items()->attach($this->item);
        $this->in_collection = $this->collection->items()->get()->contains($this->item);
    }

    public function remove_from_collection()
    {
        $this->collection->items()->detach($this->item);
        $this->in_collection = $this->collection->items()->get()->contains($this->item);
    }

    public function render()
    {
        return view('livewire.item-collections');
    }
}

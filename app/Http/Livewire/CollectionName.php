<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CollectionName extends Component
{
	public $new_name;

	public function mount($collection)
	{
		$this->collection = $collection;
	}

    public function render()
    {
        return view('livewire.collection-name');
    }

	public function submit()
	{
		$this->collection->name = $this->new_name;
		$this->collection->save();
		$this->collection_name = $this->new_name;
	}
}

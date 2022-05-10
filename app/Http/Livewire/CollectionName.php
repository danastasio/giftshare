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
		if (!$this->new_name) {
			return redirect('collection')->with(['error' => 'New name cannot be blank.']);
		} elseif (strtolower($this->new_name) === 'default collection') {
			return redirect('collection')->with(['error' => "'Default Collection' is a reserved name. Please choose another"]);
		} else {
			$this->collection->name = $this->new_name;
			$this->collection->save();
			$this->collection_name = $this->new_name;
		}
	}
}

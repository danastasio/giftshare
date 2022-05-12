<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Requests\CollectionRequest;

class CollectionName extends Component
{
    public $new_name;

    protected function rules()
    {
    	return [
    		'new_name' => 'required',
    	];
	}

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
    	$this->validate();
        $this->collection->name = $this->new_name;
        $this->collection->save();
        $this->collection_name = $this->new_name;
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Collection;

class CollectionUser extends Component
{

	public function mount($collection, $user)
	{
		$this->collection = $collection;
		$this->user = $user;
		$this->shared = count($collection->users()->wherePivot('user_id', $user->id)->get()) == 1;
	}

    public function render()
    {
        return view('livewire.collection-user');
    }

	public function share_collection()
	{
		$this->user->collections()->attach($this->collection, ['access_type' => 1]);
		$this->user->save();
		$this->shared = true;
	}

	public function revoke_collection()
	{
		$this->user->collections()->detach($this->collection);
		$this->user->save();
		$this->shared = false;
	}
}

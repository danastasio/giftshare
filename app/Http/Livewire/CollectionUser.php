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
		$this->shared = $collection->users()->get()->contains($user);
	}

    public function render()
    {
        return view('livewire.collection-user');
    }

	public function share_collection()
	{
		$this->user->shared_collections()->attach($this->collection, ['owner_id' => $this->collection->owner()->first()->id, 'access_type' => '1']);
		$this->user->save();
		$this->shared = $this->collection->users()->get()->contains($this->user);
	}

	public function revoke_collection()
	{
		$this->user->shared_collections()->detach($this->collection);
		$this->user->save();
		$this->shared = $this->collection->users()->get()->contains($this->user);
	}
}

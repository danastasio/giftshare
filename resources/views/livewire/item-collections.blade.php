<div>
	@if ($this->in_collection)
		<button wire:click="remove_from_collection" class="rounded-full bg-gray-300 w-full">
			<div class="p-2 border-2 rounded-full">
				{{ $this->collection->name }}
			</div>
		</button>
	@else
		<button wire:click="add_to_collection" class="rounded-full w-full">
			<div class="p-2 border-2 rounded-full text-center">
				{{ $this->collection->name }}
			</div>
		</button>
	@endif
</div>

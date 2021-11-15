<div>
	@if ($this->deleted_at === null)
		<div class="w-full bg-gray-800 p-2 text-gray-200 font-semibold">Item has been resored!</div>
	@else
		<button type="button" class="w-full bg-yellow-500 p-2" wire:click="restore()">Restore Item</button>
	@endif
</div>

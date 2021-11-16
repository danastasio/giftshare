<div>
	@if ($this->purchased)
		<button wire:click="toggle" class="bg-yellow-300 text-center my-auto p-2 w-full rounded-lg text-black font-semibold">Unpurchase</button>
	@else
		<button wire:click="toggle" class="bg-blue-300 text-center my-auto p-2 w-full rounded-lg text-black font-semibold">Mark Purchased</button>
	@endif
</div>

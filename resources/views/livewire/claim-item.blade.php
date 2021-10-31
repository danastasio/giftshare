<div>
	@if ( $this->claimed == 0 )
        <button wire:click='claim' class="w-full bg-gray-600 hover:bg-gray-900 text-white font-bold py-2 px-4">Claim</button>
	@elseif ($this->claimed == 1 && $this->claimant_id == auth()->user()->id)
        <button wire:click='unclaim' class="w-full bg-red-700 hover:bg-red-900 text-white font-bold py-2">Un-Claim</button>
	@endif
</div>

<div>
	@if ( $this->claimed == 0 )
        <button wire:click='claim' class="md:ml-2 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-2xl md:rounded-lg">Claim</button>
	@elseif ($this->claimed == 1 && $this->claimant_id == auth()->user()->id)
        <button wire:click='unclaim' class="md:ml-2 w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 rounded-2xl md:rounded-lg">Un-Claim</button>
	@endif
</div>

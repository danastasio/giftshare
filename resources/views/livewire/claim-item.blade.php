<div class="text-white font-bold dark:text-gray-200 w-full">
	@if (date('m') == 12)
		<!-- Christmas colors -->
		@if (!$this->claimed)
	        <button wire:click='claim' class="w-full bg-green-800 dark:bg-green-900 hover:bg-green-900 py-2">@if($this->label) Item was claimed while you were on this page @else Claim @endif </button>
		@elseif ($this->claimed && $this->claimant_id == auth()->user()->id)
        	<button wire:click='unclaim' class="w-full bg-red-700 hover:bg-red-900 dark:bg-red-900 py-2">Un-Claim</button>
		@endif
	@elseif (date('m') == 10)
		<!-- Halloween colors -->
		@if (!$this->claimed)
	        <button wire:click='claim' class="w-full bg-yellow-800 hover:bg-yellow-900 dark:bg-yellow-900 py-2">@if($this->label) Item was claimed while you were on this page @else Claim @endif </button>
		@elseif ($this->claimed && $this->claimant_id == auth()->user()->id)
        	<button wire:click='unclaim' class="w-full bg-gray-800 hover:bg-gray-900 dark:bg-gray-900 py-2">Un-Claim</button>
		@endif
	@elseif (date('m') == 7)
		<!-- 4th of July colors -->
		@if (!$this->claimed)
	        <button wire:click='claim' class="w-full bg-blue-700 hover:bg-blue-900 dark:bg-blue-900 py-2">@if($this->label) Item was claimed while you were on this page @else Claim @endif </button>
		@elseif ($this->claimed && $this->claimant_id == auth()->user()->id)
        	<button wire:click='unclaim' class="w-full bg-red-800 hover:bg-red-900 dark:bg-red-900 py-2">Un-Claim</button>
		@endif
	@else
		<!-- Default colors -->
		@if (!$this->claimed)
			<button wire:click='claim' class="w-full bg-gray-600 hover:bg-gray-900 dark:bg-gray-900 py-2">@if($this->label) Item was claimed while you were on this page @else Claim @endif </button>
		@elseif ($this->claimed && $this->claimant_id == auth()->user()->id)
			<button wire:click='unclaim' class="w-full bg-red-700 hover:bg-red-900 dark:bg-red-900 py-2">Un-Claim</button>
		@endif
	@endif
</div>

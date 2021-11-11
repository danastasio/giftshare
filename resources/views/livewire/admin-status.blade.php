<div class="text-white font-bold w-full">
	@if ( $this->is_admin == 0 )
		<button wire:click='promote' class="w-3/4 rounded-md bg-green-600 dark:bg-green-900 dark:text-gray-200 py-2">Make Admin</button>
	@elseif ($this->is_admin == 1)
		<button wire:click='demote' class="w-3/4  rounded-md bg-yellow-600 dark:bg-yellow-900 dark:text-gray-200 hover:bg-yellow-900 py-2">Make User</button>
	@endif
</div>

<div class="text-white font-bold">
	@if ( $user->is_admin == 0 )
		<button wire:click='promote' class="w-full bg-green-800 hover:bg-green-900 py-2">Make Admin</button>
	@elseif ($user->is_admin == 1)
		<button wire:click='demote' class="w-full bg-red-700 hover:bg-red-900 py-2">Make User</button>
	@endif
</div>

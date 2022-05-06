<div>
	@if (!$this->shared)
		<button wire:click="share_collection" class="rounded-full w-full" alt="Share Collection">
			<div class="p-2 flex border-2 rounded-full">
				<div class="rounded-full">
					@if ($this->user->profile_photo_path)
						<img alt="profile picture" src="{{ url('/storage/' . $this->user->profile_photo_path) }}" class="w-8 rounded-full mr-3">
					@else
						<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $this->user->name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
					@endif
				</div>
				<div class="my-auto">
					{{ $this->user->name }}
				</div>
			</div>
		</button>
	@else
		<button wire:click="revoke_collection" class="rounded-full w-full bg-gray-300" alt="Unshare collection">
			<div class="p-2 flex border-2 rounded-full">
				<div class="rounded-full">
					@if ($this->user->profile_photo_path)
						<img alt="profile picture" src="{{ url('/storage/' . $this->user->profile_photo_path) }}" class="w-8 rounded-full mr-3">
					@else
						<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $this->user->name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
					@endif
				</div>
				<div class="my-auto">
					{{ $this->user->name }}
				</div>
			</div>
		</button>
	@endif
</div>

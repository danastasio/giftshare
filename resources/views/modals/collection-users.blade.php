<div id="edit_collection_users_{{ $collection->name }}" class="invisible fixed top-0 left-0">
	<div class="bg-gray-200 dark:bg-gray-500 dark:bg-opacity-70 bg-opacity-80 grid place-items-center h-screen w-screen">
		<div class="p-5 w-3/4 md:w-1/4 bg-white dark:bg-gray-600 rounded-lg grid grid-cols-1 gap-3 shadow-xl">
			<div class="text-center">
				<div>Collection User Management</div>
				<div>{{$collection->name}}</div>
			</div>
			@foreach ($shared_with_me as $user)
				<livewire:collection-user :user=$user :collection="$collection">
			@endforeach
		</div>
	</div>
</div>


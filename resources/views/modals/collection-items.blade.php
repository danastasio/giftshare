<div id="edit_collection_items_{{ $collection->id }}" class="invisible fixed top-0 left-0">
	<div class="fixed top-0 left-0 h-screen w-screen bg-gray-200 dark:bg-gray-500 dark:bg-opacity-70 bg-opacity-80" onclick="document.getElementById('edit_collection_items_{{ $collection->id }}').classList.add('invisible');"></div>
	<div class="grid place-items-center h-screen w-screen">
		<div class="absolute p-5 w-3/4 md:w-1/4 bg-white dark:bg-gray-600 rounded-lg grid grid-cols-1 gap-3 shadow-xl">
			<div>
				<div>Collection Item Management</div>
				<div>{{ $collection->name }}</div>
			</div>
			@foreach (auth()->user()->items()->get() as $item)
				<livewire:collection-items :item=$item :collection="$collection">
			@endforeach
		</div>
	</div>
</div>


<div id="edit_item_collections_{{ $item->id }}" class="invisible fixed top-0 left-0">
	<div class="fixed top-0 left-0 h-screen w-screen bg-gray-200 dark:bg-gray-500 dark:bg-opacity-70 bg-opacity-80" onclick="document.getElementById('edit_item_collections_{{ $item->id }}').classList.add('invisible');"></div>
	<div class="grid place-items-center h-screen w-screen">
		<div class="absolute p-5 w-3/4 md:w-1/4 bg-white dark:bg-gray-600 rounded-lg grid grid-cols-1 gap-3 shadow-xl">
			<div>
				<div class="text-center text-2xl font-bold">Item Collection Management</div>
				<div class="text-center text-lg font-semibold">{{ $item->name }}</div>
				<div class="mt-2">
					@foreach($collections as $collection)
						<div class="mt-2">
							<livewire:item-collections :collection=$collection :item=$item>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>


<x-app-layout>
	<div class="bg-white rounded-lg max-w-7xl mx-auto mt-5 p-4">
		<div class="flex w-full text-lg font-bold">
			<div>Collection Management</div>
			<div class="flex-grow"></div>
			<a href="{{ route('collection.create') }}" class="flex mx-auto p-2 rounded-lg bg-green-600 text-white font-normal">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
				</svg>
				<span>Create a new collection</span>
			</a>
		</div>
		<div class="grid md:grid-cols-3 gap-3 mt-5">
			@foreach ($collections as $collection)
				<div class="grid grid-cols-1 gap-3 border-2 rounded-lg p-2">
					<div class="font-semibold text-center mx-auto mb-2">
						<livewire:collection-name :collection=$collection />
					</div>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-10 px-5">
						<button type="button" onclick="document.getElementById('edit_collection_users_{{ $collection->id }}').classList.remove('invisible');">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
							Users
						</button>

						<button onclick="document.getElementById('delete_collection_{{ $collection->id }}').classList.remove('hidden');">
							<!-- Delete SVG -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-red-600 dark:text-red-800 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				  				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
							</svg>
							Delete
						</button>
						<button type="button" onclick="document.getElementById('edit_collection_items_{{ $collection->id }}').classList.remove('invisible');">
							<!-- Bag SVG -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
							</svg>
							Items
						</button>
					</div>
					<div class="hidden" id="delete_collection_{{ $collection->id }}">
						<hr>
						<div class="flex px-5 mt-2 text-center">
							@if($collection->name === "Default Collection")
								<div class="w-full p-1 text-red-600 font-semibold">
									Cannot delete Default Collection
								</div>
							@else
								<div class="py-1 my-auto text-red-600 font-semibold">
									Really delete collection?
								</div>
								<div class="flex-grow"></div>
								<div class="flex">
									<div class="mr-2">
										<form method="POST" action="{{ route('collection.destroy', $collection->id) }}">
											@csrf
											@method('DELETE')
											<button class="text-red-600 bg-white border-2 border-red-600 p-1 px-3 rounded-lg font-semibold hover:text-white hover:bg-red-600">
												Yes
											</button>
										</form>
									</div>
									<div>
										<button class="bg-emerald-600 text-white p-1 rounded-lg px-4 border-2 border-emerald-600" onclick="document.getElementById('delete_collection_{{ $collection->id }}').classList.add('hidden');">
											No
										</button>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<div id="modals">
		@foreach($collections as $collection)
			@component('modals.collection-items', ['collection' => $collection, 'items' => $items])
			@endcomponent
			@component('modals.collection-users', ['collection' => $collection, 'shares' => $shares])
			@endcomponent
		@endforeach
	</div>
	</div>
</x-app-layout>

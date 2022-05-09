<x-app-layout>
	<div class="bg-white rounded-lg max-w-7xl mx-auto mt-5 p-4">
		<div class="flex w-full text-lg font-bold">
			<div>Collection Management</div>
			<div class="flex-grow"></div>
			<div>
				<a href="{{ route('collection.create') }}">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</a>
			</div>
		</div>
		<div class="grid md:grid-cols-3 gap-3 mt-5">
			@foreach ($collections as $collection)
				<div class="grid grid-cols-1 gap-3 border-2 rounded-lg p-2">
					<div class="font-semibold text-center mx-auto mb-2">
						<div class="hidden w-full" id="edit_collection_name_{{ $collection->id }}">
							<div class="flex justify-center">
								<input type="text" class="rounded-l-xl text-center" placeholder="{{ $collection->name }}">
								<button class="rounded-r-xl bg-emerald-600 py-auto p-2" onclick="toggle_collection_name('{{ $collection->id }}')">
									<!-- Check SVG -->
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
									</svg>
								</button>
							</div>
						</div>
						<div class="" id="collection_name_{{ $collection->id }}">
							<div class="flex w-full text-center">
								<span>
									{{ $collection->name }}
								</span>
								<span>
									<button class="flex" onclick="toggle_collection_name('{{ $collection->id }}');">
										<!-- Edit SVG -->
										<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 mx-auto text-yellow-700 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
				  							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
										</svg>
									</button>
								</span>
							</div>
						</div>
					</div>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-10 px-5">
						<button type="button" onclick="document.getElementById('edit_collection_users_{{ $collection->id }}').classList.remove('invisible');">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
							Users
						</button>

						<button>
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
				</div>
			@endforeach
		</div>
	</div>
	<div id="modals">
		@foreach($collections as $collection)
			@component('modals.collection-items', ['collection' => $collection, 'items' => $collection->items])
			@endcomponent
			@component('modals.collection-users', ['collection' => $collection, 'shared_with_me' => $shared_with_me])
			@endcomponent
		@endforeach
	</div>
	</div>
</x-app-layout>

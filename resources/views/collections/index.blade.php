<x-app-layout>
	<div class="bg-white rounded-lg max-w-7xl mx-auto mt-5 p-4">
	<h2 class="font-bold">Add Collection</h2>
	<form action="{{ route('collection.store') }}" method="post" class="mt-5">
		@csrf
		<div>
			<label for="name" class="w-full">Collection Name</label>
			<input type="text" name="name" id="name" class="w-full">
		</div>
		<button>bubmit button</button>
	</form>
	</div>
	<div class="bg-white rounded-lg max-w-7xl mx-auto mt-5 p-4">
	<div class="text-lg font-bold">Collection Management</div>
	<div class="grid md:grid-cols-3 gap-3 mt-5">
	@foreach ($collections as $collection)
		<div class="grid grid-cols-1 gap-3 border-2 rounded-lg p-2">
			<div class="font-semibold text-center">{{ $collection->name }}</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-10 px-5">
				<button type="button" onclick="document.getElementById('edit_collection_users_{{ $collection->name }}').classList.remove('invisible');">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
						</svg>
						Users
					</div>
				</button>
				<button>
					<div>
						<!-- Edit SVG -->
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-yellow-700 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		  					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
						</svg>
						Edit
					</div>
				</button>
				<button>
					<div>
						<!-- Delete SVG -->
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-red-600 dark:text-red-800 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		  					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
						</svg>
						Delete
					</div>
				</button>
				<button>
					<div>
						<!-- Bag SVG -->
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
						</svg>
						Items
					</div>
				</button>
			</div>
		</div>
		@component("modals.collection-users", ["collection" => $collection, "shared_with_me" => $shared_with_me])
			<x-slot name="modal_header">
				Collection User Management
			</x-slot>
			<x-slot name="modal_content">
				You are about to unshare you list with this person. Confirm?
			</x-slot>
		@endcomponent
	@endforeach
	</div>
</x-app-layout>

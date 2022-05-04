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
	collection management
	<div class="grid md:grid-cols-5 gap-3 mt-5">
	@foreach ($collections as $collection)
		<div class="grid grid-cols-1 gap-3 border-2 rounded-lg p-2">
			<div class="font-bold text-center">{{ $collection->name }}</div>
			<div class="grid grid-cols-2">
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
			</div>
		</div>
	@endforeach
	</div>
</x-app-layout>

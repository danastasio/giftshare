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
</x-app-layout>

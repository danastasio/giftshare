<x-app-layout>
	<!-- TODO: Save and add another -->
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
		<div class="grid grid-cols-1 gap-3 bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5 mx-3 rounded-md">
			<form action="{{ route("item.store") }}" method="post">
			@csrf

			<div class="text-2xl mb-4">Add a new item</div>
			<div>
				<label for="name" required>Item Name: <span class="text-red-700">*</span></label>
				<input type="text" class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none dark:bg-gray-400 dark:text-gray-200" name="name" id="name" value="{{ request()->name }}">
			</div>
			<div class="mt-4">
				<label for="url">Item Link:</label>
				<input type="url" placeholder="(optional)" class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none dark:bg-gray-400 dark:text-gray-200" name="url" id="url" value="{{ request()->url }}">
			</div>
			<div class="mt-4">
				<label for="description">Item Details:</label>
				<textarea placeholder="(optional)" class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none dark:bg-gray-400 dark:text-gray-200" name="description" id="description">{{ request()->description }}</textarea>
			</div>
			<div class="mt-4">
				<div class="w-full"><label for="lists">Item belongs to collections:</label></div>
				<select name="collections[]" id="collections" multiple>
					@foreach( $collections as $collection)
						<option value="{{ $collection->id }}">{{ $collection->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="flex">
				<button type=submit class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 dark:bg-blue-800">Submit</button>
			</div>
			</form>
		</div>
	</div>
</x-app-layout>

	<div class="relative flex-none max-w-1/3 gap-3 mb-2 dark:bg-gray-400 dark:text-gray-900 rounded-md p-4 mx-auto border-2 z-0">
		<div class="text-2xl md:text-lg font-semibold">
			{{ $item->name }}
		</div>
		<div class="text-lg mt-3">
			<em>{{ $item->description ?? "No Description Provided"}}</em>
		</div>
		<div class="flex w-full mt-3">
			<livewire:item-priority :item=$item>
		</div>
		<div class="flex w-full mt-3">
			<input type="text" value="{{ $item->url }}" disabled class="w-full bg-gray-200 max-h-10 rounded-l-lg truncate" id="item{{ $item->id }}">
				<a href="{{ $item->url }}" target="_blank" onclick="copyToClipboard('item{{ $item->id }}')" title="Copy URL">
				<button class="p-2 bg-gray-600 text-gray-800 dark:text-gray-800 rounded-r-lg">
					<!-- Link SVG -->
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
					</svg>
				</button>
			</a>
		</div>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-5 my-2 mt-3">
			<button type="button" class="max-h-10" onclick="document.getElementById('edit_item_collections_{{ $item->id }}').classList.remove('invisible')" title="Edit Collections">
				<!-- Collection SVG -->
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
				</svg>
				Collections
			</button>
			<button type="button" class="max-h-10" onclick="document.getElementById('edit_item_{{ $item->id }}').classList.remove('hidden');" title="Edit Item">
				<!-- Edit SVG -->
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto stroke-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
				</svg>
				Edit
			</button>
			<button type="button" class="max-h-10" onclick="document.getElementById('delete_item_{{ $item->id }}').classList.remove('hidden');" title="Delete Item">
				<!-- Delete SVG -->
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto stroke-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
				</svg>
				Delete
			</button>
		</div>
		<form method="post" id="delete_item_{{ $item->id }}" action="{{ route('item.destroy', $item->id) }}" class="hidden absolute flex flex-col inset-0 bg-white bg-opacity-95 rounded-lg">
			@csrf
			@method("DELETE")
			<div class="flex-grow"></div>
			<div id="content" class="text-center text-red-600 font-semibold w-full">
				Really delete item?
			</div>
			<div class="flex mt-3 justify-center">
				<button class="p-1 px-2 mr-2 text-red-600 hover:text-white dark:bg-red-800 dark:text-gray-200 bg-white hover:bg-red-600 dark:border-red-800 hover:bg-red-600 border-2 border-red-600 rounded-lg">Delete</button>
				<button type="button" class="p-1 px-2 text-white border-2 border-green-600 bg-green-600 dark:bg-green-800 dark:border-green-800 font-bold rounded-lg" onclick="document.getElementById('delete_item_{{ $item->id }}').classList.add('hidden');">Cancel</button>
			</div>
			<div class="flex-grow"></div>
		</form>
		<form method="POST" id="edit_item_{{ $item->id }}" action="{{ route('item.update', $item->id) }}" class="hidden p-2 absolute flex flex-col inset-0 bg-white bg-opacity-99 rounded-lg">
			@csrf
			@method('PUT')
			<label for="name">Name</label>
			<input type="text" value="{{ $item->name }}" name="name" class="rounded-lg">
			<label for="url">URL</label>
			<input type="url" value="{{ $item->url  }}" name="url" class="rounded-lg">
			<label for="description">Description</label>
			<textarea name="description" class="rounded-lg">
				{{ $item->description }}
			</textarea>
			<div class="flex-grow"></div>
			<div class="flex justify-center mt-1">
				<button type="button" class="py-1 px-2 rounded-lg bg-green-600 text-white mr-3" onclick="document.getElementById('edit_item_{{ $item->id }}').classList.add('hidden');">Cancel</button>
				<button class="py-1 px-2 rounded-lg bg-orange-600 text-white font-bold">Submit</button>
			</div>
			<div class="flex-grow"></div>
		</form>
	</div>

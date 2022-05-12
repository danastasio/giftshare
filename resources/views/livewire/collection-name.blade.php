<div class="mx-auto">
	<div class="hidden w-full" id="edit_collection_name_{{ $collection->id }}">
		<div class="flex justify-center">
				<input wire:keydown.enter="submit" type="text" class="rounded-l-xl text-center" value="{{ $this->collection->name }}" wire:model.defer="new_name">
				<button wire:click="submit" type="submit" class="rounded-r-xl bg-emerald-600 py-auto p-2" onclick="toggle_collection_name('{{ $collection->id }}')">
					<!-- Check SVG -->
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white my-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
					</svg>
				</button>
		</div>
	</div>
	<div class="mb-5" id="collection_name_{{ $collection->id }}">
		<div class="flex w-full text-center">
			<div class="flex-grow"></div>
			<div class="font-semibold">
				{{ $this->collection->name }}
			</div>
			<button class="flex-shrink" onclick="toggle_collection_name('{{ $collection->id }}');">
				<!-- Edit SVG -->
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 mx-auto text-yellow-700 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
				</svg>
			</button>
			<div class="flex-grow"></div>
		</div>
	</div>
</div>

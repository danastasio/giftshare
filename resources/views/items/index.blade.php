<?php
/*
    Copyright (C) 2020  David D. Anastasio

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
?>

<x-app-layout>
@if ( $collections->isEmpty() && $unassigned_items->isEmpty() )
	<div class="py-8">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="flex-none bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5 m-3 rounded-lg md:rounded-sm">
					<div class="w-full text-2xl mb-4 text-center">You have not added any items yet</div>
					<div class="w-full text-lg mb-4 text-center">Once you start adding items, they will show up here.</div>
					<div class="flex">
					<div class="flex-grow"></div>
					<a href="{{ route('item.create') }}" class="flex mx-auto p-2 rounded-lg bg-green-600 text-white font-normal">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
						</svg>
						<span>Create a new item</span>
					</a>
					<div class="flex-grow"></div>
				</div>
			</div>
		</div>
	</div>
@else
	<div class="mt-5">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 darkoverflow-hidden shadow-xl sm:rounded-lg p-5 mx-3 rounded-md">
				<div class="flex-none md:flex">
					<div class="flex w-full text-2xl font-semibold mb-5">
						<div class="my-auto">Your current items</div>
						<div class="flex-grow"></div>
						<a href="{{ route('item.create') }}" class="flex mx-auto p-2 rounded-lg bg-green-600 text-white font-normal">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
							</svg>
							<span>Create a new item</span>
						</a>
					</div>
					@if($availability_warning)
						<div class="ml-0 mt-2 md:mt-0 md:ml-4 flex" title="A significant number of your items have been claimed. You may want to consider adding more!">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
							</svg>
							<span class="ml-2 text-yellow-600">Low Item Availability</span>
						</div>
					@endif
				</div>

				@if (!$unassigned_items->isEmpty())
					<div id="unassigned_items" class="border-2 border-dashed border-red-600 p-5 mb-3 shadow-lg">
						<div id="header">
							<div class="text-xl text-red-600 font-bold">Unassigned Items</div>
							<div class="text-red-600 font-semibold mt-2">These items have not been assigned to a collection. Other users won't be able to see them until they are added to a collection</div>
						</div>
						<div class="flex flex-wrap">
							@foreach ($unassigned_items as $item)
								<div class="flex-none max-w-1/3 gap-3 mb-2 dark:bg-gray-400 dark:text-gray-900 rounded-md p-4 mx-auto border-2">
									<div class="text-2xl md:text-lg font-bold">
										{{ $item->name }}
									</div>
									<div class="text-lg">
										<em>{{ $item->description ?? "No Description Provided"}}</em>
									</div>
									<div class="flex w-full">
										<livewire:item-priority :item=$item>
									</div>
									<div class="flex w-full">
										<input type="text" value="{{ $item->url }}" disabled class="w-full bg-gray-200 max-h-10 rounded-l-lg hidden sm:block truncate" id="item{{ $item->id }}">
											<a href="{{ $item->url }}" target="_blank" onclick="copyToClipboard('item{{ $item->id }}')" title="Copy URL">
											<button class="p-2 sm:bg-gray-600 text-gray-800 dark:text-gray-800 rounded-lg sm:rounded-none sm:rounded-r-lg">
												<!-- Link SVG -->
												<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
												</svg>
											</button>
										</a>
									</div>
									<div class="grid grid-cols-3 my-2">
										<button type="button" class="max-h-10" onclick="document.getElementById('edit_item_collections_{{ $item->id }}').classList.remove('invisible')" title="Edit Collections">
											<!-- Collection SVG -->
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
												<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
											</svg>
											Collections
										</button>
										<button type="button" class="max-h-10" onclick="document.getElementById('edit{{ $item->id }}').classList.remove('invisible');" title="Edit Item">
											<!-- Edit SVG -->
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto stroke-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
											</svg>
											Edit
										</button>
										<button type="button" class="max-h-10" onclick="document.getElementById('delete{{ $item->id }}').classList.remove('invisible');" title="Delete Item">
											<!-- Delete SVG -->
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto stroke-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
											Delete
										</button>
									</div>
								</div>
						@endforeach
					</div>
				</div>
				@endif
				<div class="grid grid-cols-1 gap-2">
					@foreach (  $collections as $collection )
						<div class="border p-5">
							<div class="text-xl mb-2 ml-1">
								{{ $collection->name }}
							</div>
							<div class="grid grid-cols-3 gap-5">
							@foreach ($collection->items as $item)
								<div class="grid grid-cols-1 gap-3 mb-2 dark:bg-gray-400 dark:text-gray-900 rounded-md p-4 mx-auto border-2 w-full">
									<div class="text-2xl md:text-lg font-bold">
										{{ $item->name }}
									</div>
									<div class="text-lg">
										<em>{{ $item->description ?? "No Description Provided"}}</em>
									</div>
									<div class="flex w-full">
										<livewire:item-priority :item=$item>
									</div>
									<div class="flex w-full">
										<input type="text" value="{{ $item->url }}" disabled class="w-full bg-gray-200 max-h-10 rounded-l-lg hidden sm:block truncate" id="item{{ $item->id }}">
											<a href="{{ $item->url }}" target="_blank" onclick="copyToClipboard('item{{ $item->id }}')" title="Copy URL">
											<button class="p-2 sm:bg-gray-600 text-gray-800 dark:text-gray-800 rounded-lg sm:rounded-none sm:rounded-r-lg">
												<!-- Link SVG -->
												<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
												</svg>
											</button>
										</a>
									</div>
									<div class="grid grid-cols-3 my-2">
										<button type="button" class="max-h-10" onclick="document.getElementById('edit_item_collections_{{ $item->id }}').classList.remove('invisible')" title="Edit Collections">
											<!-- Collection SVG -->
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
												<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
											</svg>
											Collections
										</button>
										<button type="button" class="max-h-10" onclick="document.getElementById('edit{{ $item->id }}').classList.remove('invisible');" title="Edit Item">
											<!-- Edit SVG -->
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto stroke-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
											</svg>
											Edit
										</button>
										<button type="button" class="max-h-10" onclick="document.getElementById('delete{{ $item->id }}').classList.remove('invisible');" title="Delete Item">
											<!-- Delete SVG -->
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto stroke-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
											Delete
										</button>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				@endforeach
				@foreach ($all_items as $item)
					<div id="modals">
						@component("modals.delete-item", ["name" => "delete".$item->id,"id" => $item->id, "route" => "item.destroy", "modal_id" => "delete" . $item->id])
							<x-slot name="modal_header">
								DELETE ITEM
							</x-slot>
							<x-slot name="modal_content">
								<input type="hidden" name="id" value="{{ $item->id}}">
								You are about to delete this item. Confirm?
							</x-slot>
						@endcomponent
						@component("modals.edit-item", ["name" => "edit".$item->id, "id" => $item->id, "modal_id" => "edit" . $item->id ])
							<x-slot name="modal_header">
								<div class="font-bold text-center align-center my-auto">
									Edit Item
								</div>
							</x-slot>
							<x-slot name="modal_content">
								<div class="grid grid-cols-1 gap-3">
									<div><label for="name">Name</label></div>
									<div class="-mt-3"><input type="text" value="{{ $item->name }}" name="name" class="rounded w-full border-blue-400 dark:bg-gray-200 dark:text-gray-800"></div>
									<div class="mt-1"><label for="url">URL</label></div>
									<div class="-mt-3"><input type="url" value="{{ $item->url }}" name="url" class="rounded w-full border-blue-400 dark:bg-gray-200 dark:text-gray-800"></div>
									<div class="mt-1"><label for="description">Description</label></div>
									<div class="-mt-3"><textarea name="description" class="w-full rounded border-blue-400 dark:bg-gray-200 dark:text-gray-800">{{ $item->description }}</textarea></div>
								</div>
							</x-slot>
						@endcomponent
						@component("modals.item-collections", ["collections" => $collections, "item" => $item])
						@endcomponent
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endif
</x-app-layout>

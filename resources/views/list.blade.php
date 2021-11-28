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
			<div class="flex">
				<button type=submit class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4 dark:bg-blue-800">Submit</button>
			</div>
			</form>
		</div>
	</div>

@if ( $own_items->isEmpty() )
	<div class="py-8">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5 m-3 rounded-lg md:rounded-sm">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4 text-center">You have not added any items yet</div>
				</div>
				<div class="flex-auto text-lg mb-4 text-center">Once you start adding items, they will show up here.</div>
			</div>
		</div>
	</div>
@else
	<div class="mt-5">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 darkoverflow-hidden shadow-xl sm:rounded-lg p-5 mx-3 rounded-md">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4 text-center md:text-left">Your current list</div>
				</div>

			<div class="flex-none dark:bg-gray-500 rounded-md overflow-hidden p-2 md:p-4">
				<div class="invisible md:visible grid grid-cols-3 gap-3">
					<div class="hidden md:flex text-left pb-3">Item Name</div>
					<div class="hidden md:flex text-left pb-3">Item Details</div>
					<div class="hidden md:flex text-left pb-3 w-full"></div>
				</div>
					@foreach (  $own_items as $item )
						<div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-2 dark:bg-gray-400 dark:text-gray-900 rounded-md p-4">
							<div class="text-center md:text-left text-2xl md:text-lg font-bold md:font-normal">
								{{ $item->name }}
							</div>
							<div class="text-center md:text-left text-lg align-center">
								<em>{{ $item->description ?? "No Description Provided"}}</em>
							</div>
							<div class="flex ml-auto">
								<div class="flex w-auto">
									<input type="text" value="{{ $item->url }}" disabled class="w-auto bg-gray-200 max-h-10 rounded-l-lg hidden sm:block truncate" id="item{{ $item->id }}">
									<a href="{{ $item->url }}" target="_blank" class="p-1 max-h-10 mr-2 sm:bg-gray-600 text-gray-800 dark:text-gray-800 rounded-lg sm:rounded-none sm:rounded-r-lg" onclick="copyToClipboard('item{{ $item->id }}')" title="Copy URL">
										<!-- Link SVG -->
										<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto sm:text-white align" fill="none" viewBox="0 0 24 24" stroke="currentColor">
	  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
										</svg>
									</a>
								</div>
								<button type="button" class="max-h-10 w-1/3 mr-2 py-2 rounded-full" onclick="document.getElementById('edit{{ $item->id }}').classList.remove('invisible');" title="Edit Item">
									<!-- Edit SVG -->
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-yellow-700 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
									</svg>
								</button>
								<button type="button" class="max-h-10 w-1/3 mr-2 rounded-full text-center" onclick="document.getElementById('delete{{ $item->id }}').classList.remove('invisible');" title="Delete Item">
									<!-- Delete SVG -->
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-red-600 dark:text-red-800 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</button>
							</div>
						</div>
					@endforeach
					@foreach ($own_items as $item )
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
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endif
</x-app-layout>

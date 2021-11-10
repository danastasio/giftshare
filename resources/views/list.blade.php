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
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			View your current list below.
		</h2>
	</x-slot>

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

				<div class="grid grid-cols-5 gap-5">
					<div class="hidden md:flex text-left pb-3">Item Name</div>
					<div class="hidden md:flex text-left pb-3">Item Details</div>
					<div class="hidden md:flex text-left pb-3">Item Link</div>
					<div class="hidden md:flex text-left pb-3">Edit Item</div>
					<div class="hidden md:flex text-left pb-3">Delete Item</div>
				</div>
									<div class="grid grid-cols-5 md:grid-cols-5 gap-5">
					@foreach (  $own_items as $item )

						<div style="word-break: break-word"> <span class="flex md:hidden font-semibold text-lg">Name</span>{{ $item->name }} </div>
						<div style="word-break: break-word"> <span class="flex md:hidden font-semibold text-lg">Description</span>{{ $item->description }}</div>
						<div><span class="flex md:hidden font-semibold text-lg">URL</span> {{ $item->url }}</div>
						<button type="button" class="max-h-10 w-full bg-blue-500 dark:bg-blue-800 dark:text-gray-200 hover:bg-blue-700 text-center py-2 my-2 md:my-0 rounded-lg text-white font-bold" onclick="document.getElementById('edit{{ $item->id }}').classList.remove('invisible');">Edit</button>
						<button type="button" class="max-h-10 w-full bg-white dark:bg-red-800 dark:text-gray-200 dark:border-red-800 border-solid border-2 hover:bg-red-500 text-red-500 hover:text-white border-red-500 rounded-lg text-center py-2 font-bold" onclick="document.getElementById('delete{{ $item->id }}').classList.remove('invisible');"> Delete</button>
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
										<div class="-mt-3"><input type="text" value="{{ $item->url }}" name="url" class="rounded w-full border-blue-400 dark:bg-gray-200 dark:text-gray-800"></div>
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

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
    	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View your current list below.
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
        <div class="grid grid-cols-1 gap-3 bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<form action="{{ route('item.store') }}" method="post">
			@csrf

            <div class="text-2xl mb-4">Add a new item</div>

			<div>
				<label for="name" required>Item Name: <span class="text-red-700">*</span></label>
				<input type="text" class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none" name="name" id="name" value="{{ request()->name }}">
			</div>
			<div class="mt-4">
				<label for="url">Item Link:</label>
				<input type="url" class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none" name="url" id="url" value="{{ request()->url }}">
			</div>
			<div class="mt-4">
				<label for="description">Item Details</label>
				<textarea class="w-full mt-2 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none" name="description" id="description">{{ request()->description }}</textarea>
			</div>
            <div class="flex">
				<button type=submit class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Submit</button>
            </div>
			</form>
        </div>
    </div>
    <div class='mt-5'>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Your current list</div>
                </div>

                <div class="grid grid-cols-5">
                            <div class="text-left pb-3">Item Name</div>
                            <div class="text-left pb-3">Item Details</div>
							<div class="text-left pb-3">Item Link</div>
							<div class="text-left pb-3">Edit Item</div>
							<div class="text-left pb-3">Delete Item</div>
						@foreach (  $own_items as $item )
							<div style="word-break: break-word"> {{$item->name}} </div>
							<div style="word-break: break-word"> {{$item->description}}</div>
							<div> {{$item->url}}</div>
							<div><a href="#edit-modal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Edit</a></div>
							<div>
								<form action="{{ route('item.destroy', $item->id) }}" method="post">
									@csrf
									@method('DELETE')
									<input type="hidden" id="user_link" value="{{ $item->user_link }}">
									<input type="submit" value="Delete" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="item-delete-{{ $item->id }}" formaction="{{ route('item.destroy', $item->id) }}">
								</form>
							</div>
						@component('modals.confirmation')
							<x-slot name='modal_header'>
								Edit Item
							</x-slot>
							<x-slot name='modal_content'>
								<div class='grid grid-cols-1 gap-3'>
									<div><label for='name'>Name</label></div>
									<div><input type='text' value="{{ $item->name }}" class='rounded'></div>
									<div><label for='description'>Description</label></div>
									<div><textarea class='rounded'>{{ $item->description }}</textarea></div>
							</x-slot>
						@endcomponent
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

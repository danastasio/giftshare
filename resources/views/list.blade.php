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
            View and update your current list below.
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			@if ( request()->is_update == True )
				<form action="{{ route('item.update', request()->item_id) }}" method="post">
				@method('PUT')
			@else
				<form action="{{ route('item.store') }}" method="post">
			@endif


			<input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
			@csrf

            <div class="flex">
				@if ( request()->is_update == True )
					<div class="flex-auto text-2xl mb-4">Update an item</div>
				@else
                    <div class="flex-auto text-2xl mb-4">Add a new item</div>
				@endif
            </div>

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
				@if ( request()->is_update == True )
					<input type="submit" value="Update" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mt-4" id="item-update" formaction="{{ route('item.update', request()->item_id) }}">
					@else
					<button type=submit class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Submit</button>
					@endif
            </div>
			</form>
        </div>
    </div>
    <div >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-5">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">Your current list</div>
                </div>

                <table class="w-full text-md rounded mb-4">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left pb-3">Item Name</th>
                            <th class="text-left pb-3">Item Details</th>
							<th class="text-left pb-3">Item Link</th>
							<th class="text-left pb-3">Edit Item</th>
							<th class="text-left pb-3">Delete Item</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach (  $own_items as $item )
	                        <?php
							if (isset(parse_url($item->url)['host'])) {
                                $text = parse_url($item->url)['host'];
                            } else {
                                $text = parse_url($item->url)['path'];
	                        }?>
							<tr>
								<td style="word-break: break-word"> {{$item->name}} </td>
								<td style="word-break: break-word"> {{$item->description}}</td>
								<td> {{$item->url}}</td>
								<td>
									<div class="flex-auto text-left mt-2"> <a href="/list?name={{$item->name}}&description={{$item->description}}&url={{$item->url}}&item_id={{$item->id}}&is_update=True" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a> </div>
								</td>
								<td>
									<form action="{{ route('item.destroy', $item->id) }}" method="post">
										@csrf
										@method('DELETE')
										<input type="hidden" id="user_link" value="{{ $item->user_link }}">
										<input type="submit" value="Delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="item-delete-{{ $item->id }}" formaction="{{ route('item.destroy', $item->id) }}">
								</td>
							</tr>
						@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

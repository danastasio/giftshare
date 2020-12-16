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
                        This is your list
                </h2>
        </x-slot>
	@if ( Session::has('warning') || Session::has('info') || Session::has('error') || Session::has('success') || $errors->any() )
		<div class="py-5">
	@else
	        <div class="py-12">
	@endif
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				@if ( request()->is_update == True )
					<form action="{{ route('items.update', request()->item_id) }}" method="post">
					@method('PUT')
				@else
					<form action="{{ route('items.store') }}" method="post">
				@endif
				<input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
				<!-- CROSS Site Request Forgery Protection -->
				@csrf
                                <div class="flex">
					@if ( request()->is_update == True )
						<div class="flex-auto text-2xl mb-4">Update an item</div>
					@else
	                                        <div class="flex-auto text-2xl mb-4">Add a new item</div>
					@endif
                                </div>
				<div class="form-inline text-lg">
					<label>Item Name:</label>
					<input type="text" class="form-input" name="name" id="name" value="{{ request()->name }}">
				</div>
			        <div class="form-inline text-lg">
			                <label>Item Link:</label>
			                <input type="text" class="form-input" name="url" id="url" value="{{ request()->url }}">
		               </div>
			        <div class="form-inline text-lg">
			                <label>Item Details:</label>
			                <textarea class="form-textarea" name="description" id="description" value="{{ request()->description }}"></textarea>
		               </div>
                                <div class="flex">
					@if ( request()->is_update == True )
						<input type="submit" value="Update" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" id="item-update" formaction="{{ route('items.update', request()->item_id) }}">
					@else
						<button type=submit class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
					@endif
                                </div>
				</form>
                        </div>
                </div>
        </div>
	<?php
	$own_items = DB::table('user__items')
	            ->join('items', 'items.id', '=', 'user__items.item_id')
	            ->select('items.name', 'items.description', 'items.url','items.id', 'user__items.user_id AS user_link')
		    ->where('user__items.user_id','=',auth()->user()->id)
	            ->get();
	?>
        <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                                <div class="flex">
                                        <div class="flex-auto text-2xl mb-4">Your current list</div>
                                </div>


                                <table class="w-full text-md rounded mb-4">
                                        <thead>
                                        <tr class="border-b">
                                                <th class="text-left p-3 px-5">Item Name</th>
                                                <th class="text-left p-3 px-5">Item Details</th>
						<th class="text-left p-3 px-5">Item Link</th>
						<th class="text-left p-3 px-5">Edit Item</th>
						<th class="text-left p-3 px-5">Delete Item</th>
                                        </tr>
                                        </thead>
                                        <tbody>
					@foreach (  $own_items as $item )
						<tr>
							<td> {{$item->name}} </td>
							<td> {{$item->description}}</td>
							<td> {{$item->url}}</td>
							<td>
								<div class="flex-auto text-left mt-2"> <a href="/list?name={{$item->name}}&description={{$item->description}}&url={{$item->url}}&item_id={{$item->id}}&is_update=True" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a> </div>
							</td>
							<td>
								<form action="{{ route('items.destroy', $item->id) }}" method="post">
								@csrf
								@method('DELETE')
								<input type="hidden" id="user_link" value="{{ $item->user_link }}">
								<input type="submit" value="Delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="item-delete-{{ $item->id }}" formaction="{{ route('items.destroy', $item->id) }}">
							</td>
						</tr>
					@endforeach
                                        </tbody>
                                </table>
                                            
                        </div>
                </div>
        </div>
</x-app-layout>


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
		{{ __('My Claims') }}
	</h2>
</x-slot>
@if ( empty($claims) )
	<div class="py-8">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4 text-center">You do not have any claims yet</div>
				</div>
				<div class="flex-auto text-lg mb-4 text-center">Once you start claiming items, they will show up here.</div>
			</div>
		</div>
	</div>
@else
	<div class="py-4">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="text-center text-2xl mb-4">My claimed items</div>
					<div class='hidden md:grid grid-cols-5 gap-3 font-semibold'>
						<div class="text-left pb-3">Name</div>
						<div class="text-left pb-3">Item Name</div>
						<div class="text-left pb-3">Item Details</div>
						<div class="text-left pb-3">Item Link</div>
						<div class="text-left pb-3">Claim</div>
					</div>
					<hr class='mb-3'>
					<div class='grid grid-cols-1 md:grid-cols-5 gap-3'>
						@foreach ( $claims as $item )
							<div> {{$item['user']->name}} </div>
							<div> {{$item->name}} </div>
							<div> {{$item->description}}</div>
                        	<div class='my-auto w-full'> <a href="{{$item['url']}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" target="_blank">{{$item['url']}}</a></div>
							<div class='w-full'>
								<form action="{{ route('claim.destroy', $item->id) }}" method="post">
		                            @csrf
									@method('DELETE')
									<input type="hidden" name="item" id="item_id" value="{{ $item->id }}">
		                            <input formaction="{{ route('claim.destroy', $item->id) }}" type="submit" value="Un-claim" class="md:ml-2 w-full md:w-1/2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 md:px-4 px-24 rounded md:rounded-md">
								</form>
							</div>
						@endforeach
					</div>
			</div>
		</div>
	</div>
@endif
</x-app-layout>

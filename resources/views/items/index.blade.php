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
								<!-- Item Card -->
								@component('items.card', ['item' => $item])
								@endcomponent
							@endforeach
						</div>
					</div>
				@endif
				<div class="grid grid-cols-1 gap-2">
					@foreach (  $collections as $collection )
						<div class="border p-5">
							<div class="text-2xl mb-2 ml-1 font-bold">
								{{ $collection->name }}
							</div>
							<div class="grid grid-cols-3 gap-5">
								@foreach ($collection->items as $item)
									<!-- Item Card -->
									@component('items.card', ['item' => $item])
									@endcomponent
								@endforeach
							</div>
						</div>
					@endforeach
				</div>
				@foreach ($all_items as $item)
					<div id="modals">
						@component("modals.item-collections", ["collections" => $collections, "item" => $item])
						@endcomponent
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endif
</x-app-layout>

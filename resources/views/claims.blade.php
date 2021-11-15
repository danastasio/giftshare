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
@if ( $claims->isEmpty() )
	<div class="py-8">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5 m-3 rounded-lg md:rounded-sm">
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
		<div class="bg-white dark:text-gray-200 dark:bg-gray-600 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="text-center text-2xl mb-4">My claimed items</div>
					<div class="invisible md:visible grid grid-cols-3 gap-3">
						<div class="hidden md:flex text-left pb-3">Item Name</div>
						<div class="hidden md:flex text-left pb-3">Item Details</div>
						<div class="hidden md:flex text-left pb-3 w-full"></div>
					</div>
					<hr class="mb-3">
						@foreach ( $claims as $item )
							@php($status = "invisible")
							@php($textcolor = "text-black")
							@if($item->deleted_at === null)
								@php($textcolor = "text-gray-300")
								@php($status = null)
							@endif
						<div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-2 dark:bg-gray-400 dark:text-gray-900 rounded-md p-4 {{ $textcolor }}">
							<div class="flex my-auto">

								<div class="mr-3 {{ $status }}" title="Item has been deleted">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
									</svg>
								</div>
								<div class="text-center md:text-left text-2xl md:text-lg font-bold md:font-normal">
									{{ $item->name }}
								</div>
							</div>
							<div class="text-center md:text-left text-lg align-center">
								<em>{{ $item->description ?? "No Descripton Provided"}}</em>
							</div>
							<div class="flex ml-auto">
								<div class="flex w-auto">
									<input type="text" value="{{ $item->url }}" disabled class="w-auto bg-gray-200 max-h-10 rounded-l-lg hidden sm:block" id="item{{ $item->id }}">
									<button type="button" class="p-1 max-h-10 md:w-1/3 w-full mr-2 sm:bg-gray-600 text-gray-400 bg-gray-400 dark:text-gray-800 rounded-lg sm:rounded-none sm:rounded-r-lg justify-center" onclick="copyToClipboard('item{{ $item->id }}')" title="Copy URL">
										<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto sm:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
	  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
										</svg>
									</button>
								</div>
							</div>
							<div class="flex">
								<div class="w-1/2 rounded-l-lg overflow-hidden">
									<livewire:claim-item :item="$item" class="">
								</div>
								<div class="w-1/2 rounded-r-lg overflow-hidden">
									<p class="bg-yellow-600 h-full my-auto">
										purchased button
									</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
			</div>
		</div>
	</div>
@endif
</x-app-layout>

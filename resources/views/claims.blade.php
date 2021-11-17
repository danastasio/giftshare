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
@if ( $shared_items->isEmpty() )
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
	@foreach ( $shared_items as $person )
		@if ($person->items->isEmpty())
		@else
		<div class="py-4">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="mx-2 rounded-md bg-gray-100 md:bg-white dark:bg-gray-600 overflow-hidden shadow-xl sm:rounded-lg p-5">
					<button type="button" class="flex mb-4" onclick="toggleSection('{{ $person->id }}')" id="name{{ $person->id}}">
						<div class="mr-4 my-auto">
							<!-- Collapse Carrat -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-200 my-auto transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="chevron{{ $person->id }}">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
							</svg>
						</div>
						<div>
							@if ($person->profile_photo_path)
								<img alt="profile picture" src="{{ url('/storage/' . $person->profile_photo_path) }}" class="w-8 rounded-full mr-3">
							@else
								<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $person->name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
							@endif
						</div>
						<div class="text-2xl dark:text-gray-200">
							{{ $person->name }}
						</div>
					</button>

				<div class="flex-none" id="item-grid{{ $person-> id }}">
						@foreach($person->items as $item)
							@php($status = null)
							@php($textcolor = "text-gray-300")
							@if($item->deleted_at === null)
								@php($textcolor = "text-black")
								@php($status = "")
							@endif
							<div class="flex-none md:grid md:grid-cols-1 md:grid-cols-4 gap-3 dark:bg-gray-400 dark:text-gray-900 rounded-md p-2 mb-2 {{ $textcolor }}">
								<div class="flex-none md:flex my-auto">
									<div class="mx-auto">
										<div class="mr-3 {{ $status }}" title="Item has been deleted">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-800 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
											</svg>
										</div>
									</div>
									<div class="w-full text-center md:text-left text-2xl md:text-lg font-bold md:font-normal mb-1">
										{{ $item->name }}
									</div>
								</div>
								<div class="w-full text-center md:text-left text-lg align-center my-auto">
									<em>{{ $item->description ?? "No Description Provided"}}</em>
								</div>
								<div class="flex ml-auto w-full my-1">
										<div class="w-full p-2 h-10 bg-gray-200 border border-gray-400 max-h-10 rounded-l-lg" id="item{{ $item->id }}">
											{{ $item->url }}
										</div>
										<button type="button" class="p-1 h-10 md:mr-2 bg-gray-600 text-gray-300 bg-gray-400 dark:text-gray-800 rounded-r-lg justify-center" onclick="copyToClipboard('item{{ $item->id }}')" title="Copy URL">
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto sm:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		  										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
											</svg>
										</button>
										<div class="flex-grow"></div>
								</div>
								<div class="flex">
									<div class="w-1/2 mr-2">
											<livewire:toggle-purchase :item="$item">
									</div>
									<div class="w-1/2 rounded-lg overflow-hidden">
										<livewire:claim-item :item="$item" class="rounded-l-lg">
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endif
	@endforeach
@endif
</x-app-layout>

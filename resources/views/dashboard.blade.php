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

@if ($shared_items->isEmpty())
	<div class="py-12">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4 text-center">
						No one has shared a list with you
					</div>
				</div>
				<div class="flex-auto text-lg mb-4 text-center">
					Have someone add you to their sharing center to view their list here
				</div>
			</div>
		</div>
	</div>
@else
	@foreach ( $shared_items as $user )
		<div class="py-4">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="mx-2 rounded-md bg-gray-100 md:bg-white dark:bg-gray-600 overflow-hidden shadow-xl sm:rounded-lg p-5">
					<div class="flex">
						<div class="flex-none">
							<button type="button" class="my-auto" onclick="toggleSection('{{ $user->id }}')" id="name{{ $user->id}}">
								<div class="flex">
									<div class="mr-4 my-auto">
										<!-- Carrat SVG -->
										<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-200 my-auto transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="chevron{{ $user->id }}">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
										</svg>
									</div>
									<div>
										@if ($user->profile_photo_path)
											<img alt="profile picture" src="{{ url('/storage/' . $user->profile_photo_path) }}" class="w-8 rounded-full mr-3">
										@else
											<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $user->name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
										@endif
									</div>
									<div class="text-2xl dark:text-gray-200">
										{{ $user->name }}
									</div>
								</div>
							</button>
						</div>
						<!-- TODO: Add an indicator for the number of claimed gifts / total gifts -->
					</div>
					@if($user->visible_collections->isEmpty())
						<span class="mt-10">{{ $user->name }} has not shared any collections with you yet. When they do, this is where they will appear.</span>
					@endif
					@foreach($user->visible_collections as $collection)
						<div class="p-4">
							<div class="p-4 border rounded-xl">
								<div class="ml-1 text-xl font-semibold dark:test-gray-200">
									{{ $collection->name }}
								</div>
								@if ($collection->items->isEmpty())
									There are no items in this collection. When {{ $user->name }} adds some, this is where they will appear!
								@else
									<div class="grid grid-cols-3 gap-4 mt-5">
										@foreach($collection->items as $item)
											<div id="{{ $item->id }}" class="user{{ $collection->id }} claimed{{$item->claimed}} grid grid-cols-1 justify-between bg-white overflow-hidden shadow-2xl rounded-2xl border dark:border-gray-500 dark:bg-gray-500 dark:text-gray-200">
												<div class="w-full my-1 font-bold text-xl text-center mt-3">
												@if ($item->url)
													<a target="_blank" class="underline text-blue-600 dark:text-blue-900" href="{{$item->url}}">{{ $item->name }}</a>
												@else
													{{ $item->name }}
												@endif
												</div>
												<div class="w-full my-1 my-3 text-center text-gray-500 dark:text-gray-200 p-2">
													<em>{{  $item->description ?? "No Description Provided" }}</em>
												</div>
												<div class="mb-5 px-12">
													<div class="grid grid-cols-3">
														<button class="border rounded w-12 h-12 mx-auto bg-yellow-600">
															<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
																<path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
															</svg>
														</button>
														<button class="border rounded w-12 h-12 mx-auto bg-orange-500">
															<!-- Truck SVG -->
															<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
																<path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
																<path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
															</svg>
														</button>
														<button class="border rounded w-12 h-12 mx-auto bg-emerald-600">
															<!-- Present SVG -->
															<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
																<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
															</svg>
														</button>
													</div>
												</div>
												<div class="mt-auto">
													<livewire:claim-item :item="$item" class="w-full">
												</div>
											</div>
										@endforeach
									</div>
								@endif
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	@endforeach
@endif
</x-app-layout>

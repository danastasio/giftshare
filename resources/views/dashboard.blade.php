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
						<div class="flex mx-auto mt-5 px-4">
							<div class="relative w-full rounded-full bg-gradient-to-r from-green-500 via-yellow-500 to-red-500">
								<div class="absolute top-0 right-0 w-[{{ $claimed_item_percentage }}%] rounded-r-full bg-gray-200 h-full">
								</div>
								<div class="w-[{{ 100 - $claimed_item_percentage }}%] text-center my-auto font-bold">
									{{ 100 - round($claimed_item_percentage, 2) }}% Claimed
								</div>
							</div>
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
											<div id="{{ $item->id }}" class="relative user{{ $collection->id }} claimed{{$item->claimed}} grid grid-cols-1 justify-between bg-white overflow-hidden shadow-2xl rounded-2xl border dark:border-gray-500 dark:bg-gray-500 dark:text-gray-200">
												<div class="absolute top-1 right-1">
													@if($item->priority == '2')
														<!-- Fire SVG -->
														<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" alt="High Priority Item" role="img" aria-label="[title + description]">
															<title>High Priority Item</title>
															<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
															<path stroke-linecap="round" stroke-linejoin="round" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
														</svg>
													@elseif($item->priority == '0')
														<!-- Down-arrow SVG -->
														<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" alt="Low Piority Item" role="img" aria-label="[title + description]">
															<title>Low Priority Item</title>
															<path stroke-linecap="round" stroke-linejoin="round" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
														</svg>
													@endif
												</div>
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

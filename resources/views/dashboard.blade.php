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
	@foreach ( $shared_items as $share )
		<div class="py-4">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="mx-2 rounded-md bg-gray-100 md:bg-white dark:bg-gray-600 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex">
				<div class="flex-none">
					<button type="button" class="my-auto" onclick="toggleSection('{{ $share->id }}')" id="name{{ $share->id}}">
						<div class="flex">
							<div class="mr-4 my-auto">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-200 my-auto transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="chevron{{ $share->id }}">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
								</svg>
							</div>
							<div>
								@if ($share['owner']->profile_photo_path)
									<img alt="profile picture" src="{{ url('/storage/' . $share['owner']->profile_photo_path) }}" class="w-8 rounded-full mr-3">
								@else
									<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $share['owner']->name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
								@endif
							</div>
							<div class="text-2xl dark:text-gray-200">
								{{ $share['owner']->name }}
							</div>
						</div>
					</button>
					</div>
					<div class="flex-grow w-full">
						<livewire:toggle-privacy :share="$share">
					</div>
					</div>

					<div class="grid grid-cols-1 md:grid-cols-3 gap-5" id="item-grid{{ $share-> id }}">
						@foreach($share['items'] as $item)
							@if ((!$item->claimed) || $item->claimant_id == auth()->user()->id)
								<div id="{{ $item->id }}" class="user{{ $share['owner']->id }} claimed{{$item->claimed}} grid grid-cols-1 justify-between bg-white overflow-hidden shadow-2xl rounded-2xl border dark:border-gray-500 dark:bg-gray-500 dark:text-gray-200">
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
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif
</x-app-layout>

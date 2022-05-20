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
	@foreach ( $shares as $share )
		<div class="py-4">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="mx-2 rounded-md bg-gray-100 md:bg-white dark:bg-gray-600 overflow-hidden shadow-xl sm:rounded-lg p-5">
					<button type="button" class="flex mb-4" onclick="toggleSection('{{ $share->id }}')" id="name{{ $share->id}}">
						<div class="mr-4 my-auto">
							<!-- Collapse Carrat -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 dark:text-gray-200 my-auto transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="chevron{{ $share->id }}">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
							</svg>
						</div>
						<div>
							@if ($share->profile_photo_path)
								<img alt="profile picture" src="{{ url('/storage/' . $share->profile_photo_path) }}" class="w-8 rounded-full mr-3">
							@else
								<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $share->name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
							@endif
						</div>
						<div class="text-2xl dark:text-gray-200">
							{{ $share->name }}
						</div>
					</button>
				<div class="grid grid-cols-3 gap-5" id="item-grid{{ $share->id }}">
					@foreach($share->remote_claims as $item)
						@component('items.claimed-item', ['item' => $item])
						@endcomponent
					@endforeach
				</div>
			</div>
		</div>
	@endforeach
</x-app-layout>

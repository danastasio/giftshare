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
					<div class="hidden md:grid grid-cols-5 gap-3 font-semibold">
						<div class="text-left pb-3">Name</div>
						<div class="text-left pb-3">Item Name</div>
						<div class="text-left pb-3">Item Details</div>
						<div class="text-left pb-3">Item Link</div>
						<div class="text-left pb-3">Claim</div>
					</div>
					<hr class="mb-3">
					<div class="grid grid-cols-1 md:grid-cols-5 gap-3">
						@foreach ( $claims as $item )
							<div class="flex">
								@if ($item->profile_photo_path)
									<img alt="profile picture" src="{{ url('/storage/' . $item->profile_photo_path) }}" class="w-8 max-h-8 my-auto rounded-full mr-3">
								@else
									<img alt="generated profile picture" src="{{ url('https://ui-avatars.com/api/?name=' . $item->user_name . '&background=random&length=1&size=128') }}" class="w-8 rounded-full mr-3">
								@endif
								<span class="my-auto">{{ $item->user_name }}</span>
							</div>
							<div> {{ $item->name }} </div>
							<div> {{ $item->description }}</div>
							@if ($item-> url)
								<div class="my-auto w-full bg-green-500 hover:bg-green-700 rounded-lg text-white dark:text-gray-200 font-bold text-center py-2">
									<a href="{{ $item->url }}" class="py-auto" target="_blank">{{ parse_url($item->url, PHP_URL_HOST) }}</a>
								</div>
							@else
								<div class="md:1/5 w-full"></div>
							@endif
							<div class="w-full">
								<livewire:claim-item :item="$item">
							</div>
						@endforeach
					</div>
			</div>
		</div>
	</div>
@endif
</x-app-layout>

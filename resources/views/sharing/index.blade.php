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
	<div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-0 max-w-7xl mx-3 md:mx-auto pb-3 mt-5">
		<div class="w-full x-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex text-2xl mb-4 w-full">
					<span class="basis-5/6">Users you are sharing with</span>
					<span class="my-auto basis-1/6">
						<a href="{{ route('share.create') }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
							</svg>
						</a>
					</span>
				</div>
				<div class="grid grid-cols-2 gap-5">
					<div class="invisible md:visible">Name</div>
					<div class="invisible md:visible">Revoke Access</div>
					<div class="col-span-2"><hr></div>

					@foreach ( $shared_with_others as $share )
						<div>
							{{ $share->name }}
						</div>
						<div>
						<button type="button" class="flex w-full p-12 py-2 dark:bg-red-800 dark:text-gray-200 bg-red-500 hover:bg-red-700 text-white font-bold text-center align-middle rounded" onclick="document.getElementById('delete{{ $share->pivot->id }}').classList.remove('invisible');">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 my-auto mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
							</svg>
							Revoke
						</button>
						@component("modals.delete-item", ["name" => "delete".$share->pivot->id,"share_id" => $share->pivot->id, "id" => $share->pivot->id, "route" => "share.destroy", "modal_id" => "delete" . $share->pivot->id])
							<x-slot name="modal_header">
								Revoke List Access
							</x-slot>
							<x-slot name="modal_content">
								<input type="hidden" name="id" value="{{ $share->pivot->id}}">
								You are about to unshare you list with this person. Confirm?
							</x-slot>
						@endcomponent
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="w-full mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="text-center text-2xl mb-4">Currently sharing with you</div>
				<div class="grid grid-cols-2 gap-5">
					<div>Name</div>
					<div>Email</div>
					<hr class="col-span-2">
					@foreach ( $shared_with_me as $share )
						<div>{{ $share->name }}</div>
						<div>{{ $share->email }}</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</x-app-layout>

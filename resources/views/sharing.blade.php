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
		<h2 class="font-semibold text-xl text-gray-800 dark:bg-gray-600 dark:text-gray-200 leading-tight">
			Your registered email is: {{ auth()->user()->email }}.
		</h2>
	</x-slot>
	@if ( Session::has("warning") || Session::has("info") || Session::has("error") || Session::has("success") || $errors->any())
		<div class="py-3">
	@else
		<div class="py-8">
	@endif
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5 mx-3 md:mx-0">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4">Enter a registered email here to share your list with that user.</div>
				</div>
				<form  method="post" id="share-create">
				@csrf
				@method("POST")
				<div>
					<label for="email">Email:</label>
					<input type="email" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-50 dark:bg-gray-400 dark:text-gray-200" name="email" id="email" placeholder="example@email.com">
				</div>
				<input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
				<div class="flex pt-4">
					<input type=submit value="Share" class="bg-blue-500 dark:bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="share-create" formaction="{{ route("share.store") }}">
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-0 max-w-7xl mx-3 md:mx-auto pb-3">
		<div class="w-full x-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="text-center text-2xl mb-4">You've shared your list with</div>
				<div class="grid grid-cols-2 gap-5">
					<div class="invisible md:visible">Name</div>
					<div class="invisible md:visible">Revoke Access</div>
					<div class="col-span-2"><hr></div>

					@foreach ( $shared_with_others as $share )
						<div>
							{{ $share->name }}
						</div>
						<div>
						<button type="button" class="w-full p-12 py-2 dark:bg-red-800 dark:text-gray-200 bg-red-500 hover:bg-red-700 text-white font-bold text-center align-middle rounded" onclick="document.getElementById('delete{{ $share->pivot->id }}').classList.remove('invisible');">Revoke</button>
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

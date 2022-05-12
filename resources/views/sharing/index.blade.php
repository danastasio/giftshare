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
	<div class="flex-none max-w-5xl mx-3 md:mx-auto pb-3 mt-5">
		<div class="flex gap-2 w-full">
			<div class="w-1/2">
				<div class="text-2xl">
					Collection User Management
				</div>
				<div class="mt-3">
					Add and remove users to and from your collections
				</div>
			</div>
			<div class="w-1/2 mx-auto">
				<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
					@if($collections->isEmpty())
						<div class="flex">
						<div class="flex-grow"></div>
						<a href="{{ route('collection.create') }}" class="flex mx-auto p-2 rounded-lg bg-green-600 text-white font-normal">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
							</svg>
							<span>Create a new collection</span>
						</a>
						<div class="flex-grow"></div>
					</div>
					@endif
					@foreach( $collections as $collection )
						<div class="flex w-full py-auto mt-3">
							<div class="my-auto">
								{{ $collection->name }}
							</div>
							<div class="flex-grow"></div>
							<button class="rounded-full border p-2" type="button" onclick="document.getElementById('edit_collection_users_{{ $collection->id }}').classList.remove('invisible');">
								<div class="flex">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
									</svg>
									Users
								</div>
							</button>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="flex w-full mx-auto mt-5">
			<div class="w-1/2">
				<div class="text-2xl">
					Unique Sharing QR Code
				</div>
				<div class="mt-3 pr-2">
					Have someone else scan this QR code and you will create a share with them!
				</div>
			</div>
			<div class="w-1/2 flex-none bg-white shadow-xl rounded-lg p-5">
				<img class="mx-auto" src="https://chart.googleapis.com/chart?cht=qr&chs=150x150&chld=H&chl=https://gifts.danastas.io/qr?email= {{ auth()->user()->email }}">
			</div>
		</div>
		<div class="flex w-full mx-auto mt-5">
			<div class="w-1/2">
				<div class="text-2xl">
					Users you are sharing with
				</div>
				<div class="mt-3 pr-2">
					The users to the left can be added to one or more of your collections.
				</div>
			</div>
			<div class="w-1/2 bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex text-2xl mb-4 w-full">
					<div class="flex-grow"></div>
					<span class="my-auto">
						<a href="{{ route('share.create') }}" class="flex bg-green-600 rounded-lg px-2 text-white">
							<!-- Plus SVG -->
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 my-auto mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
							</svg>
							<span class="text-md">Create Share</span>
						</a>
					</span>
				</div>
				<div class="grid grid-cols-2 gap-5 border-2 rounded-lg p-2">
					<div class="invisible md:visible">Name</div>
					<div class="invisible md:visible">Revoke Access</div>
					<div class="col-span-2"><hr></div>
					@foreach( $shared_with_others as $share )
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
		<div class="flex w-full mx-auto mt-5">
			<div class="w-1/2">
				<div class="text-2xl">
					Users who are sharing with you
				</div>
				<div class="mt-3 pr-2">
					The users to the left have added you to their account and can share their collections with you.
				</div>
			</div>
			<div class="w-1/2 bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
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
	<div id="modals">
		@foreach( $collections as $collection )
			@component('modals.collection-users', ['collection' => $collection, 'shares' => $shares])
			@endcomponent
		@endforeach
	</div>
</x-app-layout>

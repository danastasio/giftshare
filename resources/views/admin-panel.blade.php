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
	<h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
		{{ __('Admin Panel') }}
	</h2>
</x-slot>

<!-- Stats -->
<div class="max-w-6xl mx-auto">
<div class="grid grid-cols-1 md:grid-cols-3 gap-3 text-center mt-3">
	<div class="flex-none bg-white dark:bg-gray-600 dark:text-gray-200 rounded-xl mx-auto w-1/2 px-2">
		<div class="font-bold text-2xl">
		Total Users
		</div>
		<hr class="my-1">
		<div class="text-2xl pb-2">
			{{ $no_of_users }}
		</div>
	</div>
	<div class="flex-none bg-white dark:bg-gray-600 dark:text-gray-200 rounded-xl mx-auto w-1/2 px-2">
		<div class="font-bold text-2xl">
			Total Items
		</div>
		<hr class="my-1">
		<div class="text-2xl pb-2">
			{{ $no_of_items }}
		</div>
	</div>
	<div class="flex-none bg-white dark:bg-gray-600 dark:text-gray-200 rounded-xl mx-auto w-1/2 px-2">
		<div class="font-bold text-2xl">
			Total Shares
		</div>
		<hr class="my-1">
		<div class="text-2xl pb-2">
			{{ $no_of_shares }}
		</div>
	</div>
</div>
</div>
<div class="py-6">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
				<div class="flex-auto text-2xl mb-4 text-center">Users</div>
			</div>
				<div class="w-full bg-black dark:bg-gray-200 h-0.5"></div>
				<div class="grid grid-cols-3 gap-3">
					<div class="text-left p-3 px-5">Name</div>
					<div class="text-left p-3 px-5">Email</div>
					<div class="text-left p-3 px-5">Actions</div>
					@foreach ( $user_list as $user )
						<div>{{ $user->name }}</div>
						<div>{{ $user->email }}</div>
						<div class="flex">
							<livewire:admin-status :user="$user"/>
							<button type="button" class="bg-red-600 dark:bg-red-900 rounded-md text-white dark:text-gray-200 w-3/4" onclick="document.getElementById('delete{{$user->id}}').classList.remove('invisible');">Delete User</button>
						</div>
						<!-- Begin Modal -->
							<div id="delete{{ $user->id }}" class="invisible fixed top-0 left-0">
								<div class="bg-gray-200 dark:bg-gray-500 dark:bg-opacity-70 bg-opacity-80 grid place-items-center h-screen w-screen">
									<div class="p-5 w-1/4 bg-white dark:bg-gray-600 rounded-lg grid grid-cols-1 gap-3 shadow-xl">
										<div id="header" class="font-bold text-center mb-2">
											Delete User
										</div>
										<hr>
										<div id="content" class="mt-2 text-center">
											You are about to delete: {{ $user-> name }}. <strong>This cannot be undone!</strong> Would you like to continue?
										</div>
										<div id="footer" class="mt-5">
											<div class="grid grid-cols-2 gap-3">
												<button type="button" class="items-center text-center w-full text-white border-2 bg-green-600 dark:bg-green-800 dark:border-green-800 font-bold mx-auto my-auto px-8 py-3 rounded" onclick="document.getElementById('delete{{ $user->id }}').classList.add('invisible');">Cancel</button>
												<livewire:delete-user :user="$user">
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- End Modal -->
					@endforeach
			</div>
		</div>	
	</div>
</div>
</x-app-layout>

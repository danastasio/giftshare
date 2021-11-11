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
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		{{ __('Admin Panel') }}
	</h2>
</x-slot>

@if ( empty($access_users) )
<div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
				<div class="flex-auto text-2xl mb-4 text-center">Users</div>
			</div>
				<div class="grid grid-cols-4">
					<div class="text-left p-3 px-5">Name</div>
					<div class="text-left p-3 px-5">Email</div>
					<div class="text-left p-3 px-5">Role</div>
					<div class="text-left p-3 px-5">Delete</div>
					@foreach ( $user_list as $user )
						<div>{{ $user->name }}</div>
						<div>{{ $user->email }}</div>
						<livewire:admin-status :user="$user" class="w-full"/>
						<button type="button" class="bg-red-600 w-full" onclick="document.getElementById('delete{{$user->id}}').classList.remove('invisible');">Delete User</button>
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
@endif
</x-app-layout>

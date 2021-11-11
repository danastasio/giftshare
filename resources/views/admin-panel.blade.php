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
						<livewire:adminstatus :user="$user" class="w-full"/>
						<div>
						<form action="{{ route('admin.update', 5) }}" method="post">
							<input type="hidden" id="user_id" value="CHANGEME">
							<input type="submit" value="Delete User" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="user-delete" formaction="{{ route('admin.update', 5) }}">
						</form>
						</div>
					@endforeach
			</div>
		</div>	
	</div>
</div>
@endif
</x-app-layout>

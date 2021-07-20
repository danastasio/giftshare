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
<?php
$user_list = DB::select('SELECT users.name,users.email from users');
?>

@if ( empty($access_users) )
<div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
				<div class="flex-auto text-2xl mb-4 text-center">Users</div>
			</div>
			<div class="flex-auto text-lg mb-4 text-center">
                        	<table class="w-full text-md rounded mb-4">
	                                <thead>
	        	                        <tr class="border-b">
		                                        <th class="text-left p-3 px-5">Name</th>
		                                        <th class="text-left p-3 px-5">Email</th>
		                                        <th class="text-left p-3 px-5">Role</th>
		                                        <th class="text-left p-3 px-5">Delete</th>
	                                	</tr>
        	                        </thead>
	                                <tbody>
						@foreach ( $user_list as $user )
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								<form action="{{ route('admin.update', 5) }}" method="post">
									<input type="hidden" id="user_id" value="CHANGEME">
									<input type="submit" value="Make Admin" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" id="user-promote" formaction="{{ route('admin.update', 5) }}">
								</form>
							</td>
							<td>
                                                                <form action="{{ route('admin.update', 5) }}" method="post">
                                                                        <input type="hidden" id="user_id" value="CHANGEME">
                                                                        <input type="submit" value="Delete User" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="user-delete" formaction="{{ route('admin.update', 5) }}">
                                                                </form>
							</td>
						</tr>
						@endforeach
					</tbody>
			</div>
		</div>	
	</div>
</div>
@endif
<?php
 // another query?
?>
</x-app-layout>

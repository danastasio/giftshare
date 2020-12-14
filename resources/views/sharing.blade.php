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
			Your registered email is: {{ auth()->user()->email }}
		</h2>
	</x-slot>
@if ( Session::has('warning') )
    <div class="alert alert-danger alert-block">
       {{Session::get('warning')}}
    </div>
@endif
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4">Enter someone elses registered email here to share your list with that user</div>
				</div>
				<form  method="post" id="share-create">
				@csrf
				@method('POST')
				<div class="flex">
					<div class="text-xl mb-4">Email ID:</div>
					<input type="text" class="form-input" name="email" id="email">
					<input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
				</div>
				<div class="flex">
					<input type=submit value="Share" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="share-create" formaction="{{ route('sharecontrol.store') }}">
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4">Users you're currently sharing with</div>
				</div>
				<?php
			        $shared_users = DB::table('user__users')
		                    ->join('users', 'users.id', '=', 'user__users.sharee_id')
		                    ->select('users.name','users.id','user__users.id AS share_id')
		                    ->where('user__users.owner_id','=',auth()->user()->id)
		                    ->get();
				?>
				<table class="w-full text-md rounded mb-4">
					<thead>
					<tr class="border-b">
						<th class="text-left p-3 px-5">Name</th>
						<th class="text-left p-3 px-5">Revoke Access</th>
					</tr>
					</thead>
					<tbody>
					@foreach ( $shared_users as $user )
						<tr>
							<td>{{ $user->name }}</td>
							<td>
								<form action="{{ route('sharecontrol.destroy', $user->id) }}" method="post">
								@csrf
								@method('DELETE')
								<input type=submit value="Revoke" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="share-delete-{{ $user->id }}" formaction="{{ route('sharecontrol.destroy', $user->share_id) }}">
								</form>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
					
			</div>
		</div>
	</div>
</x-app-layout>

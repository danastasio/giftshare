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
		{{ __('My Claims') }}
	</h2>
</x-slot>
<?php
$access_users = DB::select('SELECT distinct(users.name) as person_name,users.id
FROM user_items
JOIN items ON items.id = user_items.item_id
JOIN users ON users.id = user_items.user_id
WHERE user_items.user_id IN (
		SELECT owner_id
		FROM user_users
		WHERE sharee_id = ?
)
AND claimed = 1
AND claimant_id = ?
ORDER BY person_name', [auth()->user()->id,auth()->user()->id] );
?>
@if ( empty($access_users) )
<div class="py-12">
	<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
				<div class="flex-auto text-2xl mb-4 text-center">You do not have any claims yet</div>
			</div>
			<div class="flex-auto text-lg mb-4 text-center">Once you start claiming items, they will show up here.</div>
		</div>
	</div>
</div>
@endif

@foreach ( $access_users as $person )
<?php
$shared_items = DB::select('SELECT items.name, items.description, items.url, items.id, users.name AS person_name, items.id, user_items.claimed, user_items.claimant_id
FROM user_items
JOIN items ON items.id = user_items.item_id
JOIN users ON users.id = user_items.user_id
WHERE user_items.user_id IN (
	SELECT owner_id
	FROM user_users
	WHERE sharee_id = ?
	AND owner_id = ?
)
AND claimed = 1
AND claimant_id = ?
ORDER BY person_name', [auth()->user()->id,$person->id,auth()->user()->id] );
?>
<div class="py-8">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
				<div class="flex-auto text-2xl mb-4">{{$person->person_name}}</div>
			</div>
			<table class="w-full text-md rounded mb-4">
				<thead>
				<tr class="border-b">
					<th class="text-left p-3 px-5">Name</th>
					<th class="text-left p-3 px-5">Item Name</th>
					<th class="text-left p-3 px-5">Item Details</th>
					<th class="text-left p-3 px-5">Item Link</th>
					<th class="text-left p-3 px-5">Claim</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
		@foreach ($shared_items as $item)
			@if ($item->claimed == 0 || $item->claimed == 1 && $item->claimant_id == auth()->user()->id)
			<tr>
				<td> {{$item->person_name}} </td>
				<td> {{$item->name}} </td>
				<td> {{$item->description}}</td>
				<td> <a href="{{$item->url}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" target="_blank">Link</a></td>
				<td>
					<form id="share-delete" method="post">
										@csrf
					@method('DELETE')
										<input type="hidden" name="user" id="current_user" value="{{ auth()->user()->id }}">
					<input type="hidden" name="item" id="item_id" value="{{ $item->id }}">
					<input type="hidden" name="page" id="page_name" value="claims">
										<input type="submit" value="Un-Claim" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded" formaction="{{ route('claim.destroy', $item->id) }}">
					</form>
				</td>
			</tr>
			@endif
		@endforeach
				</tbody>
			</table>
			
		</div>
	</div>
</div>
@endforeach
</x-app-layout>

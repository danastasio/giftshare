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
		{{ __('Dashboard') }}
	</h2>
</x-slot>
<div class="pb-4">
<!-- This is just here to give some space before the first card. Its needed because the first card doesn't get created until the foreach loop. Adding any space there would add space to every card. Adding padding to <h2> would just increase the header, not add space below it. -->
</div>
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
ORDER BY person_name', [auth()->user()->id] );
?>
@if ( empty($access_users) )
<div class="py-12">
	<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
<div class="flex-auto text-2xl mb-4 text-center">No one has shared a list with you</div>
			</div>
			<div class="flex-auto text-lg mb-4 text-center">Have someone add you to their sharing center to view their list here</div>
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
		ORDER BY person_name', [auth()->user()->id,$person->id] );
		$item_count = 0;
	?>
	<div class="py-4">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-gray-100 md:bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div x-data={show:true}>
					<button  @click="show=!show" type="button">
						<div class="flex">
							<div class="flex-auto text-2xl mb-4">> {{$person->person_name}}</div>
						</div>
					</button>
				<div x-show="show">
					@foreach ($shared_items as $item)
						@if ($item->claimed == 0 || $item->claimed == 1 && $item->claimant_id == auth()->user()->id)
							<?php $item_count += 1 ?>
						@endif
					@endforeach
				
					@if ($item_count == 0)
						<div class="flex-auto text-lg mb-4 text-center">
							This person has not added any items to their list or they have all been claimed.
						</div>
					@else
						@foreach ($shared_items as $item)
							<?php if (isset(parse_url($item->url)['host'])) {
								$text = parse_url($item->url)['host'];
								} else {
								$text = parse_url($item->url)['path'];
							}?>
							@if ($item->claimed == 0 || $item->claimed == 1 && $item->claimant_id == auth()->user()->id)
								<div id="newcard" class="md:flex flex-none hover:bg-gray-300 bg-white overflow-hidden shadow-xl md:shadow-sm rounded-2xl md:rounded-sm p-3 mb-4 md:mb-0">
									<div class="md:w-1/5 w-full pb-2">
										<div class="md:hidden"><strong>Person Name</strong></div>
										{{$person->person_name}}
									</div>
									<div class="md:w-1/5 w-full pb-2">
										<div class="md:hidden"><hr><strong>Item Name</strong></div>
										{{$item->name}}
									</div>
									<div class="md:w-1/5 w-full pb-2">
										<div class="md:hidden"><hr><strong>Description</strong></div>
										{{$item->description}}
									</div>
									<div class="md:w-1/5 w-full pb-2">
										@if ( !empty($text))
										<form target="_blank">
											<input type="submit" formaction="{{$item->url}}" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 md:px-4 px-24 rounded-2xl md:rounded-lg" value="{{$text}}">
										</form>
										@endif
									</div>
									<div class="md:w-1/5 w-full">
										@if ( $item->claimed == 0 )
											<form action="{{ route('claim.store') }}" method="post">
							                                        @csrf
							                                        <input type="hidden" name="user" id="current_user" value="{{ auth()->user()->id }}">
												<input type="hidden" name="item" id="item_id" value="{{ $item->id }}">
							                                        <input type="submit" value="Claim" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-2xl md:rounded-lg">
											</form>
										@elseif ($item->claimed == 1 && $item->claimant_id == auth()->user()->id)
											<form action="{{ route('claim.destroy', $item->id) }}" method="post">
							                                        @csrf
												@method('DELETE')
							                                        <input type="hidden" name="user" id="current_user" value="{{ auth()->user()->id }}">
												<input type="hidden" name="item" id="item_id" value="{{ $item->id }}">
							                                        <input type="submit" value="Un-claim" class="w-full bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 md:px-4 px-24 rounded-2xl md:rounded-lg">
											</form>
										@endif
									</div>
								</div>
							@endif
						@endforeach
					@endif
				</div>	
			</div>
		</div>
	</div>
@endforeach
</x-app-layout>

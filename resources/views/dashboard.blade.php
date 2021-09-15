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
@if ( $shared_items->isEmpty()) )
	<div class="py-12">
		<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4 text-center">
						No one has shared a list with you
					</div>
				</div>
				<div class="flex-auto text-lg mb-4 text-center">
					Have someone add you to their sharing center to view their list here
				</div>
			</div>
		</div>
	</div>
@else

	@foreach ( $shared_items as $person )
		<div class="py-4">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-gray-100 md:bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
					<div x-data={show:true}>
						<button  @click="show=!show" type="button">
							<div class="text-2xl mb-4">
								{{ $person->name }}
								<img src="{{ url('/images/chevron.svg') }}" class="transform w-4 my-auto rotate-90">
							</div>
						</button>

						<div x-show="show">
							<div id="header-card" class="md:flex hidden">
								<div class='w-1/5'>
									<strong>Person Name</strong>
								</div>
								<div class='w-1/5'>
									<strong>Item Name</strong>
								</div>
								<div class='w-1/5'>
									<strong>Item Description</strong>
								</div>
								<div class='w-1/5'>
									<strong>Item Link</strong>
								</div>
								<div class='w-1/5'>
									<strong>Claim Button</strong>
								</div>
							</div>
							<div class="invisible md:visible">
								<hr>
							</div>
							@foreach($person->items as $item)
								<div id="newcard" class="md:flex flex-none hover:bg-gray-300 bg-white overflow-hidden shadow-xl md:shadow-sm rounded-2xl md:rounded-sm p-3 mb-4 md:mb-0 border md:border-transparent">
									<div class="md:w-1/5 w-full mb-2">
										<div class="md:hidden">
											<strong>Person Name</strong>
										</div>
										{{  $person->name  }}
									</div>
									<div class="md:w-1/5 w-full my-1">
										<div class="md:hidden">
											<hr class="mb-2">
											<strong>Item Name</strong>
										</div>
										{{ $item->name }}
									</div>
									<div class="md:w-1/5 w-full my-1">
										<div class="md:hidden">
											<hr class="mb-2">
											<strong>Description</strong>
										</div>
										{{  $item->description  }}
									</div>
									<div class="md:w-1/5 w-full bg-green-500 hover:bg-green-700 rounded-2xl md:rounded-lg text-center py-2 my-1 md:my-0">
										<a href="{{ $item->url }}" target="_blank" class="text-white font-bold py-auto">{{ parse_url($item->url, PHP_URL_HOST) }}</a>
									</div>
									<div class="md:w-1/5 w-full">
										<livewire:claim-item :item="$item">
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif
</x-app-layout>

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
@if(Session::has('info'))
	@php
		$text_color = "text-white dark:text-gray-200";
		$bg_color = "bg-gray-500 dark:bg-gray-700";
		$message = Session::get('info');
	@endphp
@elseif(Session::has('success'))
	@php
		$text_color = "text-white dark:text-gray-200";
		$bg_color = "bg-green-600 dark:bg-green-800";
		$message = Session::get('success');
	@endphp
@elseif(Session::has('error'))
	@php
		$text_color = "text-white dark:text-gray-200";
		$bg_color = "bg-red-600 dark:bg-red-800";
		$message = Session::get('error');
	@endphp
@elseif(Session::has('warning'))
	@php
		$text_color = "text-white dark:text-gray-200";
		$bg_color = "bg-yellow-700 dark:bg-yellow-900";
		$message = Session::get('warning');
	@endphp
@else
	@php
		$text_color = null;
		$bg_color = "bg-red-600";
		$message = null;
	@endphp
@endif

<div id="flash_messages">
	@if ( $errors->any() )
		<div class="flex">
			<div class="pt-5">
				<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
					<div class="text-white bg-red-700 rounded-lg p-4 text-center dark:text-gray-200 dark:bg-red-800">
						<ul>
							@foreach ($errors->all() as $error)
								<li><strong>{{ __($error) }}</strong></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
				</svg>
			</div>
		</div>
	@elseif (!empty($message))
		<div class="mt-2">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="relative {{ $text_color }} {{ $bg_color }} rounded-lg p-4 text-center">
					<strong>{{ $message }}</strong>
					<div class="absolute top-1 right-1">
						<button onclick="document.getElementById('flash_messages').remove()">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
							</svg>
						</button>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

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
@if(Session::has('success'))
<div class="pt-2">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="text-white bg-green-600 rounded-lg p-4 text-center dark:text-gray-200 dark:bg-green-800">
			<strong>{{ Session::get('success') }}</strong>
		</div>
	</div>
</div>
@endif

@if (Session::has('error') || $errors->any())
	@if ( $errors->any() )
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
	@else
		<div class="pt-5">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="text-white bg-red-700 rounded-lg p-4 text-center dark:text-gray-200 dark:bg-red-800">
					<strong>{{ __(Session::get('error') ) }}</strong>
				</div>
			</div>
		</div>
	@endif
@endif

@if (Session::has('warning'))
<div class="pt-2">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="text-white bg-yellow-700 rounded-lg p-4 text-center dark:text-gray-200 dark:bg-yellow-900">
			<strong>{{ __(Session::get('warning')) }}</strong>
		</div>
	</div>
</div>
@endif

@if (Session::has('info'))
<div class="pt-2">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="text-white bg-gray-400 rounded-lg p-4 text-center dark:text-gray-200 dark:bg-gray-700">
			<strong>{{ __(Session::get('info')) }}</strong>
		</div>
	</div>
</div>
@endif

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
 // query for users goes here
?>

@if ( empty($access_users) )
<div class="py-12">
	<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
			<div class="flex">
				<div class="flex-auto text-2xl mb-4 text-center">Users</div>
			</div>
			<div class="flex-auto text-lg mb-4 text-center">
				users will go here
			</div>
		</div>
	</div>
</div>
@endif
<?php
 // another query?
?>
</x-app-layout>

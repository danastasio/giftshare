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
@if (Session::has('success'))
<div class="pt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="color: #c6f6d5;background-color: #2f855a;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
                        <strong>{{ __(Session::get('success') ) }}</strong>
                </div>
        </div>
</div>
@endif

@if (Session::has('error') || $errors->any())
	@if ( $errors->any() )
		<div class="pt-5">
		        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		                <div class="flex justify-center" style="color: #fed7d7;background-color: #c53030;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
					<ul>
						@foreach ($errors->all() as $error)
							<li><strong>{{ __($error) }}</strong></li>
						@endforeach
					</ul>
				</div>
			</div>
	@else
		<div class="pt-5">
		        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		                <div style="color: #fed7d7;background-color: #c53030;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
		                        <strong>{{ __(Session::get('error') ) }}</strong>
		                </div>
		        </div>
		</div>
	@endif
@endif

@if (Session::has('warning'))
<div class="pt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="color: #b7791f;background-color: #fefcbf;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
			<strong>{{ __(Session::get('warning')) }}</strong>
                </div>
        </div>
</div>
@endif

@if (Session::has('info'))
<div class="pt-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="color: #4a5568;background-color: #cbd5e0;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
			<strong>{{ __(Session::get('info')) }}</strong>
                </div>
        </div>
</div>
@endif

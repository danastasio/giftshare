
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-700 dark:text-gray-200 border-gray-100 sticky top-0">
	<!-- Primary Navigation Menu -->
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex justify-between h-16">
			<div class="flex mx-auto md:mx-0">
				<!-- Logo -->
				<div class="flex items-center transform scale-75">
					<a href="{{ route('dashboard') }}">
						<x-jet-authentication-card-logo />
					</a>
				</div>

				<!-- Navigation Links -->
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="dark:text-gray-200">
						<div class="flex">
							<div class="my-auto mr-1">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
								</svg>
							</div>
							<div class="my-auto">
								{{ __('Dashboard') }}
							</div>
						</div>
					</x-jet-nav-link>
				</div>
				 <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-jet-nav-link href="{{ route('claim.index') }}" :active="request()->routeIs('claim.index')" class="dark:text-gray-200">
						<div class="flex">
							<div class="my-auto mr-1">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
								</svg>
							</div>
							<div class="my-auto">
								{{ __('My Claims') }}
							</div>
						</div>
					</x-jet-nav-link>
				</div>
			   <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-jet-nav-link href="{{ route('list') }}" :active="request()->routeIs('list')" class="dark:text-gray-200">
						<div class="flex">
							<div class="my-auto mr-1">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
								</svg>
							</div>
							<div class="my-auto">
								{{ __('My Items') }}
							</div>
						</div>
					</x-jet-nav-link>
				</div>
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-jet-nav-link href="{{ route('collection.index') }}" :active="request()->routeIs('claim.index')" class="dark:text-gray-200">
						<div class="flex">
							<div class="my-auto mr-1">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
								</svg>
							</div>
							<div class="my-auto">
								{{ __('My Collections') }}
							</div>
						</div>
					</x-jet-nav-link>
				</div>
				<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
					<x-jet-nav-link href="{{ route('share.index') }}" :active="request()->routeIs('share.index')" class="dark:text-gray-200">
						<div class="flex">
							<div class="my-auto mr-1">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
								</svg>
							</div>
							<div class="my-auto">
								{{ __('Sharing Center') }}
							</div>
						</div>
					</x-jet-nav-link>
				</div>
				<div class="flex items-end justify-end mx-auto my-auto ml-5">
					<div class="flex justify-end items-center space-x-2 mx-auto relative">
						<span class="text-xs font-extralight dark:text-gray-200">Light </span>
						<div>
							<input type="checkbox" name="" id="checkbox" class="hidden" />
							<label for="checkbox" class="cursor-pointer" onclick="toggleDarkMode();">
								<div class="w-9 h-5 flex items-center bg-gray-300 rounded-full p2 switch z-0 relative">
									<span class="ml-0.5 absolute">
										<!-- Sun SVG -->
										<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
										</svg>
									</span>
									<span class="absolute ml-5">
										<!-- Moon SVG -->
										<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
										</svg>
									</span>
								<div class="w-4 h-4 bg-white rounded-full shadow switch-ball ml-0.5 relative z-10"></div>
								</div>
							</label>
						</div>
						<span class="text-xs font-bold dark:text-gray-200">Dark</span>
					</div>
				</div>
			</div>

			<!-- Settings Dropdown -->
			<div class="hidden sm:flex sm:items-center sm:ml-6">
				<x-jet-dropdown align="right" width="48">
					<x-slot name="trigger">
						@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
							<button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
								<img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
							</button>
						@else
							<button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-200 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
								<div>{{ Auth::user()->name }}</div>

								<div class="ml-1">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
									</svg>
								</div>
							</button>
						@endif
					</x-slot>

					<x-slot name="content">
						<!-- Account Management -->
						<div class="block px-4 py-2 text-xs text-gray-400">
							{{ __('Manage Account') }}
						</div>

						<x-jet-dropdown-link href="{{ route('profile.show') }}">
							{{ __('Profile') }}
						</x-jet-dropdown-link>

						@if (Laravel\Jetstream\Jetstream::hasApiFeatures())
							<x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
								{{ __('API Tokens') }}
							</x-jet-dropdown-link>
						@endif

			@if (auth()->user()->is_admin)
				<x-jet-dropdown-link href="{{ route('admin.index') }}">
					{{ __('Admin Panel') }}
				</x-jet-dropdown-link>
			@endif
				<x-jet-dropdown-link href="{{ route('deleted') }}">
					{{ __('Deleted Items') }}
				</x-jet-dropdown-link>

						<div class="border-t border-gray-100"></div>

						<!-- Team Management -->
						@if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
							<div class="block px-4 py-2 text-xs text-gray-400">
								{{ __('Manage Team') }}
							</div>

							<!-- Team Settings -->
							<x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
								{{ __('Team Settings') }}
							</x-jet-dropdown-link>

							@can('create', Laravel\Jetstream\Jetstream::newTeamModel())
								<x-jet-dropdown-link href="{{ route('teams.create') }}">
									{{ __('Create New Team') }}
								</x-jet-dropdown-link>
							@endcan

							<div class="border-t border-gray-100"></div>

							<!-- Team Switcher -->
							<div class="block px-4 py-2 text-xs text-gray-400">
								{{ __('Switch Teams') }}
							</div>

							@foreach (Auth::user()->allTeams() as $team)
								<x-jet-switchable-team :team="$team" />
							@endforeach

							<div class="border-t border-gray-100"></div>
						@endif

						<!-- Authentication -->
						<form method="POST" action="{{ route('logout') }}">
							@csrf

							<x-jet-dropdown-link href="{{ route('logout') }}"
												onclick="event.preventDefault();
															this.closest('form').submit();">
								{{ __('Logout') }}
							</x-jet-dropdown-link>
						</form>
					</x-slot>
				</x-jet-dropdown>
			</div>

			<!-- Hamburger -->
			<div class="-mr-2 flex items-center sm:hidden">
				<button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						<path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Responsive Navigation Menu -->
	<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
		<div class="pt-2 pb-3 space-y-1">
			<x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="dark:text-gray-200">
				{{ __('Dashboard') }}
			</x-jet-responsive-nav-link>
		</div>
		<div class="pt-2 pb-3 space-y-1">
			<x-jet-responsive-nav-link href="{{ route('claim.index') }}" :active="request()->routeIs('claim.index')" class="dark:text-gray-200">
				{{ __('My Claims') }}
			</x-jet-responsive-nav-link>
		</div>
		<div class="pt-2 pb-3 space-y-1">
			<x-jet-responsive-nav-link href="{{ route('list') }}" :active="request()->routeIs('list')" class="dark:text-gray-200">
				{{ __('My List') }}
			</x-jet-responsive-nav-link>
		</div>
		<div class="pt-2 pb-3 space-y-1">
			<x-jet-responsive-nav-link href="{{ route('share.index') }}" :active="request()->routeIs('share.index')" class="dark:text-gray-200">
				{{ __('Sharing Center') }}
			</x-jet-responsive-nav-link>
		</div>

		<!-- Responsive Settings Options -->
		<div class="pt-4 pb-1 border-t border-gray-200">
			<div class="flex items-center px-4">
				<div class="flex-shrink-0">
					<img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
				</div>

				<div class="ml-3">
					<div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
					<div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
				</div>
			</div>

			<div class="mt-3 space-y-1">
				<!-- Account Management -->
				<x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')" class="dark:text-gray-200">
					{{ __('Profile') }}
				</x-jet-responsive-nav-link>

				@if (Laravel\Jetstream\Jetstream::hasApiFeatures())
					<x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')" class="dark:text-gray-200">
						{{ __('API Tokens') }}
					</x-jet-responsive-nav-link>
				@endif

				<!-- Authentication -->
				<form method="POST" action="{{ route('logout') }}">
					@csrf

					<x-jet-responsive-nav-link href="{{ route('logout') }}" class="dark:text-gray-200"
									onclick="event.preventDefault();
												this.closest('form').submit();">
						{{ __('Logout') }}
					</x-jet-responsive-nav-link>
				</form>

				<!-- Team Management -->
				@if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
					<div class="border-t border-gray-200"></div>

					<div class="block px-4 py-2 text-xs text-gray-400">
						{{ __('Manage Team') }}
					</div>

					<!-- Team Settings -->
					<x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
						{{ __('Team Settings') }}
					</x-jet-responsive-nav-link>

					<x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
						{{ __('Create New Team') }}
					</x-jet-responsive-nav-link>

					<div class="border-t border-gray-200"></div>

					<!-- Team Switcher -->
					<div class="block px-4 py-2 text-xs text-gray-400">
						{{ __('Switch Teams') }}
					</div>

					@foreach (Auth::user()->allTeams() as $team)
						<x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
					@endforeach
				@endif
			</div>
		</div>
	</div>
</nav>

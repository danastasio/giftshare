<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link rel="stylesheet" href="{{ url('/css/modal.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://cdn.tailwindcss.com/"></script>

		<!-- Style -->
		<style>
    		#checkbox:checked + label .switch-ball{
				background-color: white;
				transform: translateX(16px);
				transition: transform 0.2s linear;
    		}
    		#checkbox:not(:checked) + label .switch-ball{
      			background-color: white;
      			transition: transform 0.2s linear;
			}
  		</style>

  		<!-- Scripts -->

    </head>
    <body class="font-sans antialiased">

        <x-jet-banner />

        <div class="min-h-screen bg-gray-200 dark:bg-gray-800">
			@include('navigation-dropdown')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-600 dark:text-gray-200 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

			@include('flash-message')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts
		<script>
			if (localStorage.theme === 'dark' || window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.classList.add('dark');
				document.getElementById("checkbox").checked = true;
			} else {
				document.documentElement.classList.remove('dark');
				document.getElementById("checkbox").checked = false;
			}
			function toggleDarkMode() {
				if (localStorage.theme === 'light' || 'theme' in localStorage === false) {
					localStorage.theme = "dark";
	  				document.documentElement.classList.add('dark')
	  				var result = true;
				} else {
					localStorage.theme = "light";
	  				document.documentElement.classList.remove('dark')
	  				var result = false;
				}
				return result;
			}

			function copyToClipboard(divid) {
				/* Get the text field */
				var copyText = document.getElementById(divid);
				/* Select the text field */
				let content = copyText.innerHTML.trim();

				/* Copy the text inside the text field */
				navigator.clipboard.writeText(content);
			}

			function toggleSection(divid) {
				let rotation = "rotate-90";
				let marginBottom = "mb-4";
				let chevron = document.getElementById("chevron" + divid);
				let itemGrid = document.getElementById("item-grid" + divid);
				let nameBox = document.getElementById("name" + divid);

				// Rotate Chevron
				if (chevron.classList.contains(rotation)) {
					chevron.classList.remove(rotation);
					itemGrid.classList.add("hidden");
					nameBox.classList.remove(marginBottom);

				} else {
					chevron.classList.add(rotation);
					itemGrid.classList.remove("hidden");
					nameBox.classList.add(marginBottom);
				}
			}
			function toggle_privacy(divid) {
				let claimed_items = document.getElementsByClassName(divid);
				for (let i=0;i<claimed_items.length;i++) {
	  				if (claimed_items[i].classList.contains('claimed1') && !claimed_items[i].classList.contains('hidden')) {
	    				claimed_items[i].classList.add('hidden');
	  				} else {
	      				claimed_items[i].classList.remove('hidden');
    				}
				}
			}
			function toggle_claim(divid) {
				let claimed_item = document.getElementById(divid);
	  			if (claimed_item.classList.contains('claimed0') || claimed_item.classList.contains('claimed')) {
	    			claimed_item.classList.add('claimed1');
	    			claimed_item.classList.remove('claimed0');
	  			} else {
	      			claimed_item.classList.add('claimed0');
	      			claimed_item.classList.remove('claimed1');
    			}
			}
			Livewire.on('toggle_privacy', divid => {
				toggle_privacy(divid);
			});
			Livewire.on('toggle_claim', divid => {
				toggle_claim(divid);
			});
		</script>
    </body>

</html>

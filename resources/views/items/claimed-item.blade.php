<div id="{{ $item->id }}" class="w-1/3 mr-3 claimed{{$item->claimed}} grid grid-cols-1 justify-between bg-white overflow-hidden shadow-2xl rounded-2xl border dark:border-gray-500 dark:bg-gray-500 dark:text-gray-200">
	<div class="absolute top-1 right-1">
		@if($item->priority == '2')
			<!-- Fire SVG -->
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" alt="High Priority Item" role="img" aria-label="[title + description]">
				<title>High Priority Item</title>
				<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
				<path stroke-linecap="round" stroke-linejoin="round" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
			</svg>
		@elseif($item->priority == '0')
			<!-- Down-arrow SVG -->
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" alt="Low Piority Item" role="img" aria-label="[title + description]">
				<title>Low Priority Item</title>
				<path stroke-linecap="round" stroke-linejoin="round" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
			</svg>
		@endif
	</div>
	<div class="w-full my-1 font-bold text-xl text-center mt-3">
		@if ($item->url)
			<a target="_blank" class="underline text-blue-600 dark:text-blue-900" href="{{$item->url}}">{{ $item->name }}</a>
		@else
			{{ $item->name }}
		@endif
	</div>
	<div class="w-full my-1 my-3 text-center text-gray-500 dark:text-gray-200 p-2">
		<em>{{  $item->description ?? "No Description Provided" }}</em>
	</div>
	<div class="flex-none md:flex mt-auto w-full">
		<livewire:item-purchased :item="$item" class="max-w-1/3" />
		<livewire:item-wrapped :item=$item class="max-w-1/3" />
		<livewire:claim-item :item="$item" class="max-w-1/3" />
	</div>
</div>

<x-app-layout>
	<div class="mt-5 p-2 text-center w-full mx-auto">
		<p class="mx-auto bg-gray-600 max-w-prose rounded-lg p-2 font-bold text-lg text-center">
			Here you can view the items that you have previously deleted
		</p>
		<p>
			TODO: list the deleted items here
			TODO: Make a livewire undelete button
		</p>
		<div>
			@if ($deleted_items->isEmpty())
				You do not have any deleted items. If you delete something, it can be restored here.
			@else
				Deleted Items:
				<div class="grid grid-cols-3 gap-2 max-w-7xl mx-auto">
				@foreach ($deleted_items as $item)
 					<div id="newcard" class="grid grid-cols-1 justify-between bg-white overflow-hidden shadow-2xl rounded-2xl border dark:border-gray-500 dark:bg-gray-500 dark:text-gray-200">
						<div class="flex-none w-full mb-2 justify-center flex mx-auto mt-4">
							<img src="{{ $item->image_url ?? url('/images/not_found.svg')}}" class="h-24" alt="product image">
						</div>
						<div class="w-full my-1 font-bold text-xl text-center mt-3">
							@if ($item->url)
								<a target="_blank" class="underline text-blue-600 dark:text-blue-900" href="{{$item->url}}">{{ $item->name }}</a>
							@else
								{{ $item->name }}
							@endif
						</div>
						<div class="w-full my-1 my-3 text-center text-gray-500 dark:text-gray-200">
							<em>{{  $item->description ?? "No Description Provided" }}</em>
						</div>
						<div class="w-full h-full mt-auto">
							<livewire:restore-item :item="$item" class="w-full">
						</div>
					</div>
				@endforeach

		@endif
	</div>
</x-app-layout>

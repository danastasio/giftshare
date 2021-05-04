<x-app-layout>
    <x-slot name="header">
    </x-slot>
	<div class="py-6">
		<div class="flex justify-center">
			<form>
				Wishlist ID
				<input type=submit class="bg-white border-solid border-blue-500 text-blue-500 hover:bg-blue-700 text-white font-bold px-4 rounded" value="Import from Amazon" formaction="{{ route('amazon') }}">	
			<form>
		</div>
	</div>
</x-app-layout>

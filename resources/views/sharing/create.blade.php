<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:bg-gray-600 dark:text-gray-200 leading-tight">
			Your registered email is: {{ auth()->user()->email }}.
		</h2>
	</x-slot>
	@if ( Session::has("warning") || Session::has("info") || Session::has("error") || Session::has("success") || $errors->any())
		<div class="py-3">
	@else
		<div class="py-8">
	@endif
		TODO Qr code?
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-600 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5 mx-3 md:mx-0">
				<div class="flex">
					<div class="flex-auto text-2xl mb-4">Enter a registered email here to share your collections with that user.</div>
				</div>
				<form  method="post" id="share-create">
				@csrf
				@method("POST")
				<div>
					<label for="email">Email:</label>
					<input type="email" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-50 dark:bg-gray-400 dark:text-gray-200" name="email" id="email" placeholder="example@email.com">
				</div>
				<input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
				<div class="flex pt-4">
					<input type=submit value="Share" class="bg-blue-500 dark:bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="share-create" formaction="{{ route("share.store") }}">
				</div>
				</form>
			</div>
		</div>
	</div>
</x-app-layout>

<div id="{{ $name }}" class="invisible fixed top-0 left-0">
	<div class="bg-gray-200 bg-opacity-80 grid place-items-center h-screen w-screen">
		<div class="p-5 w-1/2 bg-white rounded-lg grid grid-cols-1 gap-3 shadow-xl">
		<form method="post" action="{{ route($route, $id) }}">
			@csrf
			@method("DELETE")
			<div id="header" class="font-bold text-center">
				{{ $modal_header }}
			</div>
			<hr>
			<div id="content">
				{{ $modal_content }}
			</div>
			<div id="footer" class="mt-5">
				<div class="grid grid-cols-2 gap-3">
					<button type="button" class="items-center text-center w-full text-white border-2 bg-green-600 font-bold mx-auto my-auto px-8 py-3 rounded" onclick="document.getElementById('{{ $modal_id }}').classList.add('invisible');">Cancel</button>
					<button class="text-red-600 hover:text-white font-bold px-8 py-3 bg-white hover:bg-red-600 hover:bg-red-600 border-2 border-red-600 rounded">Delete</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>

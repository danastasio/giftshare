<div id='{{ $name }}' class='overlay bg-gray-200 bg-opacity-80'>
	<div class='p-5 w-1/2 bg-white rounded-lg grid grid-cols-1 gap-3 shadow-xl'>
		<form method="post" action="{{ route('share.destroy', $share_id) }}">
			@csrf
			@method("DELETE")
			<div id='header' class='font-bold text-center'>
				{{ $modal_header }}
			</div>
			<hr>
			<div id='content'>
				<div class='text-center'>
					{{ $modal_content }}
				</div>
			</div>
			<div id='footer' class='mt-5'>
				<div class='grid grid-cols-2 gap-3'>
					<a href='#' class='shares-center text-center hover:text-white w-full text-white bg-green-600 font-bold mx-auto my-auto px-8 py-3 rounded'>Cancel</a>
					<button class='text-red-600 hover:text-white font-bold px-8 py-3 bg-white hover:bg-red-600 hover:bg-red-600 border-2 border-red-600 rounded'>Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>

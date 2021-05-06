<div id='edit-modal' class='overlay bg-gray-200 bg-opacity-90'>
	<div class='p-5 bg-white rounded-lg grid grid-cols-1 gap-3'>
		<div id='header' class='font-bold text-center'>
			{{ $modal_header }}
		</div>
		<hr>
		<div id='content'>
			{{ $modal_content }}
		</div>
		<div id='footer' class='mt-5'>
			<div class='grid grid-cols-2 gap-3'>
				<a href='#' class='mx-auto my-auto px-8 py-3 bg-red-400 rounded'>Cancel</a>
				<button class='px-8 py-3 bg-green-400 rounded'>Submit</button>
			</div>
		</div>
	</div>
</div>

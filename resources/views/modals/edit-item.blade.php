<div id='edit-modal' class='overlay bg-gray-200 bg-opacity-80'>
	<div class='p-5 w-1/2 bg-white rounded-lg grid grid-cols-1 gap-3 shadow-xl'>
		<div id='header' class='font-bold text-center'>
			{{ $modal_header }}
		</div>
		<hr>
		<div id='content'>
			{{ $modal_content }}
		</div>
		<div id='footer' class='mt-5'>
			<div class='grid grid-cols-2 gap-3'>
				<a href='#' class='items-center text-center hover:bg-red-600 hover:text-white w-full text-red-600 border-2 border-red-600 bg-white font-bold mx-auto my-auto px-8 py-3 rounded'>Cancel</a>
				<button class='text-white font-bold px-8 py-3 bg-green-600 hover:bg-green-800 rounded'>Submit</button>
			</form>
			</div>
		</div>
	</div>
</div>

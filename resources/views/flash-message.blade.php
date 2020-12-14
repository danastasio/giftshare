@if (Session::has('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Session::get('success')</strong>
	</div>
@endif

@if (Session::has('error'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Session::get('error')</strong>
	</div>
@endif

@if (Session::has('warning'))
	<div class="alert alert-warning alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Session::get('warning')</strong>
	</div>
@endif

@if (Session::has('info'))
	<div class="alert alert-info alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>Session::get('info')</strong>
	</div>
@endif

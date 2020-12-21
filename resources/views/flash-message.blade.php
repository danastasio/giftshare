@if (Session::has('success'))
<div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="color: #c6f6d5;background-color: #2f855a;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
                        <strong>{{Session::get('success')}}</strong>
                </div>
        </div>
</div>
@endif

@if (Session::has('error') || $errors->any())
	@if ( $errors->any() )
		<div class="py-5">
		        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		                <div style="color: #fed7d7;background-color: #c53030;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
					<ul>
						@foreach ($errors->all() as $error)
							<li><strong>{{ $error }}</strong></li>
						@endforeach
					</ul>
				</div>
			</div>
	@else
		<div class="py-5">
		        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		                <div style="color: #fed7d7;background-color: #c53030;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
		                        <strong>{{Session::get('error')}}</strong>
		                </div>
		        </div>
		</div>
	@endif
@endif

@if (Session::has('warning'))
<div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="color: #b7791f;background-color: #fefcbf;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
			<strong>{{Session::get('warning')}}</strong>
                </div>
        </div>
</div>
@endif

@if (Session::has('info'))
<div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div style="color: #4a5568;background-color: #cbd5e0;position: relative;border-radius: 0.5rem;padding-top: 0.75rem; padding-bottom: 0.75rem;padding-right: 0.75rem; padding-left: 0.75rem;">
			<strong>{{Session::get('info')}}</strong>
                </div>
        </div>
</div>
@endif

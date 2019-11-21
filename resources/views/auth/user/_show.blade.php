<div class="row">
	<div class="col-12 my-4">
		<div class="row">
			<div class="col-4 offset-4">
				<img src="{{ Auth::user()->avatar() }}" class="img img-circle col-12" alt="User Avatar">
			</div>
		</div>
	</div>
</div>
<p class="h3 text-center mb-4">{{ Auth::user()->name }}</p>
<div class="row">
	<div class="col-5 offset-1">
		<p>Phone</p>
	</div>
	<div class="col-6">
		<p>: <strong>{{ Auth::user()->phone }}</strong></p>
	</div>

	<div class="col-5 offset-1">
		<p>Access Level</p>
	</div>
	<div class="col-6">
		<p>: <strong>{{ Auth::user()->role->name }}</strong></p>
	</div>

	<div class="col-5 offset-1">
		<p>Last Update</p>
	</div>
	<div class="col-6">
		<p>: <strong>{{ Auth::user()->updated_at->diffForHumans() }}</strong></p>
	</div>
</div>
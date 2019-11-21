@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-4">
		<div class="card">
			<div class="card-body">
				@include('auth.user._show')
			</div>
		</div>
	</div>
	<div class="col-8">
		<div class="card">
			<div class="card-body">
				@include('auth.user._password')
			</div>
		</div>
	</div>
</div>
@endsection
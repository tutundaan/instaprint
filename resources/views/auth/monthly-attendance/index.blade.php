@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
		<div class="card card-body">
			@include('auth.monthly-attendance._table')
		</div>
	</div>
</div>
@endsection
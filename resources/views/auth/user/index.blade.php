@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
		@include('auth.user._create')
	</div>
	<div class="col-12">
		<div class="card">
			<div class="card-header">
			  <h3 class="card-title">Registered Users</h3>
			  <div class="card-tools">
			  	{{ $users->links() }}
			  </div>
			</div>
			<div class="card-body">
				@include('auth.user._table')
			</div>
		</div>
	</div>
</div>
@endsection
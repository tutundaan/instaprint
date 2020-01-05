@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
			  <h3 class="card-title">Pengguna Terdaftar</h3>
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

@section('options')
	<div class="col-3 offset-9">
		@include('auth.user._create')
	</div>
@endsection

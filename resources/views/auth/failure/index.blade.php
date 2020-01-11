@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12">
        @include('partials._basic-search', [ 'action' => route('auth.failure.index'), 'key' => 'job', 'partials' => 'auth.failure._filter'])
	</div>

	<div class="col-12">
		<div class="card">
			<div class="card-header">
			  <h3 class="card-title">Hasil Import SPK Kesalahan</h3>
			  <div class="card-tools">
			  	{{ $failures->links() }}
			  </div>
			</div>
			<div class="card-body">
			@include('auth.failure._table')
			</div>
			<div class="card-footer">
			  <div class="card-tools">
			  	{{ $failures->links() }}
			  </div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('options')
	<div class="col-3 offset-9">
		@include('auth.failure._create')
	</div>
@endsection

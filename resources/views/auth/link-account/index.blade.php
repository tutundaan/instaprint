
@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
		@include('auth.user._create')
	</div>
	<div class="col-12">
		<div class="card">
			<div class="card-header">
			  <h3 class="card-title">Link Akun</h3>
			  <div class="card-tools">
			  	{{ $employees->links() }}
			  </div>
			</div>
			<div class="card-body">
				@include('auth.link-account._table')
			</div>
		</div>
	</div>
</div>
@endsection

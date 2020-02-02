
@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12">
        @include('partials._basic-search', [ 'action' => route('auth.link-account.index'), 'key' => 'id'])
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
			<div class="card-footer">
			  	{{ $employees->links() }}
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

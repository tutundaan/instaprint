
@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12">
        @include('partials._basic-search', [ 'action' => route('auth.employee.index'), 'key' => 'nama'])
	</div>

	<div class="col-12">
		<div class="card">
			<div class="card-header">
			  <h3 class="card-title">Tabel Karyawan</h3>
			  <div class="card-tools">
			  	{{ $employees->links() }}
			  </div>
			</div>
			<div class="card-body">
				@include('auth.employee._table')
			</div>
			<div class="card-footer">
			  	{{ $employees->links() }}
			</div>
		</div>
	</div>
</div>
@endsection

@section('options')
@endsection

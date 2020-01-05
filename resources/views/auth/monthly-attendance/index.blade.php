@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
        <div class="card card-default">
            <div class="card-body">
                @include('auth.monthly-attendance._table')
            </div>
		</div>
	</div>
</div>
@endsection

@section('options')
    @if(Auth::user()->isAdmin())
        <a class="btn btn-success btn-sm float-right" href="{{ route('auth.monthly-attendance.create') }}">Import Data Excel</a>
    @endif
@endsection

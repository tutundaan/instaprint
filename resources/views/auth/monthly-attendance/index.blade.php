@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
        <div class="card card-default">
            @if(Auth::user()->isAdmin())
                <div class="card-header">
                    <a class="btn btn-success" href="{{ route('auth.monthly-attendance.create') }}">Import Data Excel</a>
                </div>
            @endif
            <div class="card-body">
                @include('auth.monthly-attendance._table')
            </div>
		</div>
	</div>
</div>
@endsection

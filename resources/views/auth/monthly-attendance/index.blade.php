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
	<div class="col-3 offset-9">
		@include('auth.monthly-attendance._create')
	</div>
    @endif
@endsection

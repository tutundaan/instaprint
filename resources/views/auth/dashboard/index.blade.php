@extends('layouts.app')

@section('content')

<div class="row mb-4">
    <div class="col-3">
        <current-user-component user="{{ Auth::user() }}"></current-user-component>
    </div>
    <div class="col-9">
        <recomendations-component></recomendations-component>
    </div>
</div>

<employee-dashboard-component employees="{{ route('api.employee.index') }}" token="{{ Auth::user()->api_token }}"></employee-dashboard-component>

@endsection

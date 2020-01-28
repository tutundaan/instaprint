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

<div class="row">
    <div class="col-3">
        <employee-list-component></employee-list-component>
    </div>
    <div class="col-7">
    </div>
    <div class="col-2">
        <current-employee-component></current-employee-component>
    </div>
</div>

@endsection

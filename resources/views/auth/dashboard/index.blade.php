@extends('layouts.app')

@section('content')

    <employee-dashboard-component
        employees="{{ route('api.employee.index') }}"
        token="{{ Auth::user()->api_token }}"></employee-dashboard-component>

@endsection

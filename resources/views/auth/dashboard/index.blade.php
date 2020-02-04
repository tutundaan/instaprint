@extends('layouts.app')

@section('content')

    <employee-dashboard-component
        employees="{{ route('api.employee.index') }}"
        rank="{{ route('api.rank.index') }}"
        user="{{ Auth::user() }}"
        employee="{{ Auth::user()->isEmployee() ? Auth::user()->employee->id  : null }}"
        token="{{ Auth::user()->api_token }}"></employee-dashboard-component>

@endsection

@extends('layouts.app')

@section('content')
	@include('auth.user._table')
	@include('auth.user._create')
@endsection
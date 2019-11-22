@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
		<form action="{{ route('auth.monthly-attendance.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="file" name="attendance">
			<input type="submit" value="Import">
		</form>
	</div>
</div>
@endsection
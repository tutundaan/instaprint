@extends('layouts.main')

@section('content')
<div class="row">
	<div>
		<p>Ubah Password</p>
		<form action="{{ route('auth.user.change-password', Auth::user()) }}" method="POST">
			@csrf
			@method('PUT')

			<div>
				<label for="last_password">Last Password</label>
				<input type="password" name="last_password">
			</div>

			<div>
				<label for="password">New Password</label>
				<input type="password" name="password">
			</div>

			<div>
				<label for="password_confirmation">Confirmation New Password</label>
				<input type="password" name="password_confirmation">
			</div>

			<div>
				<input type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
@endsection
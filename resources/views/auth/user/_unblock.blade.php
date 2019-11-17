@if ($user->is_blocked and !$user->currentlyLogin())
	<form action="{{ route('auth.user.unblock', $user) }}" method="POST">
		@csrf
		@method('PUT')
		<input type="submit" value="Unblock" class="btn btn-success btn-xs btn-block">
	</form>
@endif
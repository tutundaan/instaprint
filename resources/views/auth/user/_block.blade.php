@if (!$user->is_blocked and !$user->currentlyLogin())
	<form action="{{ route('auth.user.block', $user) }}" method="POST">
		@csrf
		@method('PUT')
		<input type="submit" value="Blok Akses" class="btn btn-warning btn btn-xs btn-block">
	</form>
@endif

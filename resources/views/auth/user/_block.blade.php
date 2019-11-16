@if (!$user->is_blocked and !$user->currentlyLogin())
	<form action="{{ route('auth.user.block', $user) }}" method="POST">
		@csrf
		@method('PUT')
		<input type="submit" value="Block" class="btn btn-warning">
	</form>
@endif
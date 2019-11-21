<form action="{{ route('auth.user.change', Auth::user()) }}" method="POST">
	@csrf
	@method('PUT')

	<div class="form-group">
		<label for="phone">Phone</label>
		<input type="text" name="phone" class="form-control">
	</div>

	<div class="form-group">
		<input type="submit" value="Change" class="btn btn-success float-right">
	</div>
</form>
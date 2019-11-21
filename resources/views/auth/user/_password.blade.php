<p class="lead">Ubah Password</p>
<form action="{{ route('auth.user.change-password', Auth::user()) }}" method="POST">
	@csrf
	@method('PUT')

	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<label for="last_password">Last Password</label>
				<input type="password" name="last_password" class="form-control">
			</div>
		</div>
		<div class="col-6">			
			<div class="form-group">
				<label for="password">New Password</label>
				<input type="password" name="password" class="form-control">
			</div>
		</div>
		<div class="col-6">
			<div class="form-group">
				<label for="password_confirmation">Confirmation New Password</label>
				<input type="password" name="password_confirmation" class="form-control">
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<input type="submit" value="Submit" class="btn btn-success float-right">
			</div>
		</div>
	</div>

</form>
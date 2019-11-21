<div class="form-group">
  <label for="name">Name</label>
  <input class="form-control" type="text" name="name" value="{{ $user->name ?? '' }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="phone">Phone</label>
  <input class="form-control" type="text" name="phone" value="{{ $user->phone ?? '' }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input class="form-control" type="password" name="password" value="{{ old('password') }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="password_confirmation">Password Confirmation</label>
  <input class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="role">Role</label>
  <select name="role" class="form-control" required="true">
    @foreach ($roles as $role)
      <option value="{{ $role->slug }}" {{ ($user->role->name ?? null) === $role->name ? 'selected' : null }}>{{ $role->name }}</option>
    @endforeach
  </select>
</div>